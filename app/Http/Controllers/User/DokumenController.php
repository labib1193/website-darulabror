<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

                // Delete old file if exists
                if ($dokumen->$field && Storage::exists($dokumen->$field)) {
                    Storage::delete($dokumen->$field);
                }

                // Generate unique filename
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = $field . '_' . $user->id . '_' . time() . '.' . $extension;

                // Store file
                $path = $file->storeAs('dokumen/' . $user->id, $filename, 'public');

                // Update dokumen data
                $dokumen->$field = $path;
                $dokumen->{$field . '_original'} = $originalName;
                $dokumen->{$field . '_size'} = $file->getSize();
                $dokumen->{$field . '_uploaded_at'} = now();

                $uploadedFiles[] = $field;
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
            return redirect()->back()->with('error', 'Data dokumen tidak ditemukan.');
        }

        $allowedFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        if (!in_array($field, $allowedFields)) {
            return redirect()->back()->with('error', 'Field dokumen tidak valid.');
        }

        // Delete file from storage
        if ($dokumen->$field && Storage::exists($dokumen->$field)) {
            Storage::delete($dokumen->$field);
        }

        // Clear dokumen data
        $dokumen->$field = null;
        $dokumen->{$field . '_original'} = null;
        $dokumen->{$field . '_size'} = null;
        $dokumen->{$field . '_uploaded_at'} = null;
        $dokumen->save();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
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

        $filePath = storage_path('app/public/' . $dokumen->$field);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }

        $originalName = $dokumen->{$field . '_original'} ?? 'dokumen.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return response()->download($filePath, $originalName);
    }
}
