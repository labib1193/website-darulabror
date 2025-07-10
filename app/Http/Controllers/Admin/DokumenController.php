<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumen = Dokumen::with('user')->latest()->paginate(10);
        return view('admin.dokumen.index', compact('dokumen'));
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_ijazah' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'surat_sehat' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'pas_foto' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        // Check if user already has dokumen
        $existingDokumen = Dokumen::where('user_id', $request->user_id)->first();
        if ($existingDokumen) {
            return redirect()->back()->with('error', 'User ini sudah memiliki data dokumen.');
        }

        $data = [
            'user_id' => $request->user_id,
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_verifikasi' => $request->catatan_verifikasi
        ];

        // Handle file uploads
        $fileFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                try {
                    // Upload to Cloudinary menggunakan API yang lebih reliable
                    $originalName = $file->getClientOriginalName();
                    $publicId = 'dokumen/' . $field . '_' . $request->user_id . '_' . time();

                    $cloudinary = new \Cloudinary\Cloudinary();
                    $uploadResult = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                        'public_id' => $publicId,
                        'folder' => 'dokumen',
                        'resource_type' => 'auto',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]);

                    // Update data with Cloudinary URL
                    $data[$field] = $uploadResult['secure_url'];
                    $data[$field . '_original'] = $originalName;
                    $data[$field . '_size'] = $file->getSize();
                    $data[$field . '_uploaded_at'] = now();
                } catch (\Exception $e) {
                    Log::error('Cloudinary upload failed for ' . $field . ': ' . $e->getMessage(), [
                        'user_id' => $request->user_id,
                        'field' => $field,
                        'error' => $e->getMessage()
                    ]);
                    return redirect()->back()
                        ->with('error', 'Gagal mengupload ' . $field . '. Silakan coba lagi.')
                        ->withInput();
                }
            }
        }

        Dokumen::create($data);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function show(Dokumen $dokumen)
    {
        return view('admin.dokumen.show', compact('dokumen'));
    }

    public function edit(Dokumen $dokumen)
    {
        return view('admin.dokumen.edit', compact('dokumen'));
    }
    public function update(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'foto_ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'foto_ijazah' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'surat_sehat' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'pas_foto' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $data = $request->only(['status_verifikasi', 'catatan_verifikasi']);

        // Handle file uploads
        $fileFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                try {
                    // Delete old file if exists
                    if ($dokumen->$field) {
                        $this->deleteOldFile($dokumen->$field);
                    }

                    // Upload to Cloudinary menggunakan API yang lebih reliable
                    $originalName = $file->getClientOriginalName();
                    $publicId = 'dokumen/' . $field . '_' . $dokumen->user_id . '_' . time();

                    $cloudinary = new \Cloudinary\Cloudinary();
                    $uploadResult = $cloudinary->uploadApi()->upload($file->getRealPath(), [
                        'public_id' => $publicId,
                        'folder' => 'dokumen',
                        'resource_type' => 'auto',
                        'quality' => 'auto',
                        'fetch_format' => 'auto'
                    ]);

                    // Update data with Cloudinary URL
                    $data[$field] = $uploadResult['secure_url'];
                    $data[$field . '_original'] = $originalName;
                    $data[$field . '_size'] = $file->getSize();
                    $data[$field . '_uploaded_at'] = now();
                } catch (\Exception $e) {
                    Log::error('Cloudinary upload failed for ' . $field . ': ' . $e->getMessage(), [
                        'user_id' => $dokumen->user_id,
                        'field' => $field,
                        'error' => $e->getMessage()
                    ]);
                    return redirect()->back()
                        ->with('error', 'Gagal mengupload ' . $field . '. Silakan coba lagi.')
                        ->withInput();
                }
            }
        }

        $dokumen->update($data);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil diupdate.');
    }
    public function destroy(Dokumen $dokumen)
    {
        // Hapus semua file yang ada
        $fileFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        foreach ($fileFields as $field) {
            if ($dokumen->$field) {
                $this->deleteOldFile($dokumen->$field);
            }
        }

        $dokumen->delete();
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Download specific dokumen file
     */
    public function download(Dokumen $dokumen, $field)
    {
        $allowedFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        if (!in_array($field, $allowedFields)) {
            return redirect()->back()->with('error', 'Field dokumen tidak valid.');
        }

        if (!$dokumen->$field) {
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
                    Cloudinary::destroy($publicId);
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
}
