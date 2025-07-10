<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Cloudinary\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary as CloudinaryFacade;

class DokumenController extends Controller
{
    /**
     * Display the dokumen page
     */
    public function index()
    {
        $dokumen = Auth::user()->dokumen;

        return view('user.dokumen', compact('dokumen'));
    }

    /**
     * Store or update dokumen
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_ijazah' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'surat_sehat' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'pas_foto' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
        ];

        $messages = [
            'foto_ktp.image' => 'Foto KTP harus berupa gambar',
            'foto_ktp.mimes' => 'Foto KTP harus berformat JPEG, JPG, atau PNG',
            'foto_ktp.max' => 'Ukuran foto KTP maksimal 2MB',
            'foto_ijazah.image' => 'Foto Ijazah harus berupa gambar',
            'foto_ijazah.mimes' => 'Foto Ijazah harus berformat JPEG, JPG, atau PNG',
            'foto_ijazah.max' => 'Ukuran foto ijazah maksimal 2MB',
            'surat_sehat.file' => 'Surat keterangan sehat harus berupa file',
            'surat_sehat.mimes' => 'Surat keterangan sehat harus berformat JPEG, JPG, PNG, atau PDF',
            'surat_sehat.max' => 'Ukuran surat keterangan sehat maksimal 2MB',
            'foto_kk.image' => 'Foto Kartu Keluarga harus berupa gambar',
            'foto_kk.mimes' => 'Foto Kartu Keluarga harus berformat JPEG, JPG, atau PNG',
            'foto_kk.max' => 'Ukuran foto kartu keluarga maksimal 2MB',
            'pas_foto.image' => 'Pas foto harus berupa gambar',
            'pas_foto.mimes' => 'Pas foto harus berformat JPEG, JPG, atau PNG',
            'pas_foto.max' => 'Ukuran pas foto maksimal 1MB',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $dokumen = $user->dokumen ?? new Dokumen(['user_id' => $user->id]);

        // Process each file upload
        $uploadedFiles = [];
        $fileFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                try {
                    // Delete old file if exists
                    if ($dokumen->$field) {
                        $this->deleteOldFile($dokumen->$field);
                    }

                    // Upload to Cloudinary
                    $originalName = $file->getClientOriginalName();
                    $publicId = 'dokumen/' . $field . '_' . $user->id . '_' . time();

                    Log::info('Starting Cloudinary upload', [
                        'user_id' => $user->id,
                        'field' => $field,
                        'file_name' => $originalName,
                        'file_size' => $file->getSize(),
                        'public_id' => $publicId
                    ]);

                    // Check if Cloudinary is properly configured
                    if (empty(config('cloudinary.cloud_url'))) {
                        Log::error('Cloudinary not configured properly', [
                            'cloud_url' => config('cloudinary.cloud_url'),
                            'notification_url' => config('cloudinary.notification_url')
                        ]);
                        throw new \Exception('Cloudinary configuration missing');
                    }

                    // Menggunakan Cloudinary API yang lebih reliable
                    $cloudinary = new \Cloudinary\Cloudinary();
                    $uploadResult = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                        'public_id' => $publicId,
                        'folder' => 'dokumen',
                        'resource_type' => 'auto',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]);

                    Log::info('Cloudinary upload successful', [
                        'field' => $field,
                        'secure_url' => $uploadResult['secure_url'],
                        'public_id' => $uploadResult['public_id']
                    ]);

                    // Update dokumen data with Cloudinary URL
                    $dokumen->$field = $uploadResult['secure_url'];
                    $dokumen->{$field . '_original'} = $originalName;
                    $dokumen->{$field . '_size'} = $file->getSize();
                    $dokumen->{$field . '_uploaded_at'} = now();

                    $uploadedFiles[] = $field;
                } catch (\Exception $e) {
                    Log::error('Cloudinary upload failed for ' . $field, [
                        'user_id' => $user->id,
                        'field' => $field,
                        'error_message' => $e->getMessage(),
                        'error_trace' => $e->getTraceAsString(),
                        'file_name' => $originalName ?? 'unknown',
                        'cloudinary_config' => [
                            'cloud_url_exists' => !empty(config('cloudinary.cloud_url')),
                            'notification_url_exists' => !empty(config('cloudinary.notification_url'))
                        ]
                    ]);
                    return redirect()->back()
                        ->with('error', 'Gagal mengupload ' . $field . '. Error: ' . $e->getMessage())
                        ->withInput();
                }
            }
        }

        // Save dokumen
        $dokumen->save();

        if (empty($uploadedFiles)) {
            return redirect()->back()->with('warning', 'Tidak ada file yang dipilih untuk diupload.');
        }

        $uploadedCount = count($uploadedFiles);
        $message = "Berhasil mengupload {$uploadedCount} dokumen.";

        return redirect()->back()->with('success', $message);
    }

    /**
     * Delete specific dokumen
     */
    public function delete(Request $request, $field)
    {
        $user = Auth::user();
        $dokumen = $user->dokumen;

        if (!$dokumen) {
            return response()->json([
                'success' => false,
                'message' => 'Data dokumen tidak ditemukan.'
            ], 404);
        }

        // Check if document is already verified - prevent deletion if approved
        if ($dokumen->status_verifikasi === 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen yang sudah diverifikasi tidak dapat dihapus. Silakan hubungi admin jika perlu perubahan.'
            ], 403);
        }

        $allowedFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        if (!in_array($field, $allowedFields)) {
            return response()->json([
                'success' => false,
                'message' => 'Field dokumen tidak valid.'
            ], 400);
        }

        // Check if the specific field has a file
        if (!$dokumen->$field) {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen tidak ditemukan.'
            ], 404);
        }

        // Delete file from storage or Cloudinary
        if ($dokumen->$field) {
            $this->deleteOldFile($dokumen->$field);
        }

        // Clear dokumen data
        $dokumen->$field = null;
        $dokumen->{$field . '_original'} = null;
        $dokumen->{$field . '_size'} = null;
        $dokumen->{$field . '_uploaded_at'} = null;
        $dokumen->save();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen berhasil dihapus.'
        ]);
    }

    /**
     * Delete old file from storage or Cloudinary
     */
    private function deleteOldFile(?string $filePath): void
    {
        if (!$filePath) {
            return;
        }

        try {
            // Check if it's a Cloudinary URL
            if (filter_var($filePath, FILTER_VALIDATE_URL) && str_contains($filePath, 'cloudinary.com')) {
                // Extract public_id from Cloudinary URL
                $publicId = $this->extractPublicIdFromCloudinaryUrl($filePath);
                if ($publicId) {
                    CloudinaryFacade::destroy($publicId);
                }
            } else {
                // Delete local storage file
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to delete old file: ' . $e->getMessage());
        }
    }

    /**
     * Extract public_id from Cloudinary URL
     */
    private function extractPublicIdFromCloudinaryUrl(string $url): ?string
    {
        try {
            $parsedUrl = parse_url($url);
            $pathParts = explode('/', $parsedUrl['path']);

            // Find the index after version (v1234567890)
            $versionIndex = null;
            foreach ($pathParts as $index => $part) {
                if (preg_match('/^v\d+$/', $part)) {
                    $versionIndex = $index;
                    break;
                }
            }

            if ($versionIndex !== null) {
                // Get path parts after version
                $publicIdParts = array_slice($pathParts, $versionIndex + 1);
                $publicId = implode('/', $publicIdParts);

                // Remove file extension
                $publicId = preg_replace('/\.[^.]*$/', '', $publicId);

                return $publicId;
            }
        } catch (\Exception $e) {
            Log::error('Failed to extract public_id from Cloudinary URL: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Download specific dokumen
     */
    public function download($field)
    {
        $user = Auth::user();
        $dokumen = $user->dokumen;

        if (!$dokumen || !$dokumen->$field) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        $filePath = $dokumen->$field;

        // Check if it's a Cloudinary URL
        if (filter_var($filePath, FILTER_VALIDATE_URL)) {
            // For Cloudinary URLs, redirect to the URL for download
            return redirect($filePath);
        }

        // For local storage files
        $localPath = storage_path('app/public/' . $filePath);

        if (!file_exists($localPath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }

        $originalName = $dokumen->{$field . '_original'} ?? 'dokumen.' . pathinfo($localPath, PATHINFO_EXTENSION);

        return response()->download($localPath, $originalName);
    }
}
