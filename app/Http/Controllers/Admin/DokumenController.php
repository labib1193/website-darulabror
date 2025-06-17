<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

                // Generate unique filename
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = $field . '_' . $request->user_id . '_' . time() . '.' . $extension;

                // Store file
                $path = $file->storeAs('dokumen/' . $request->user_id, $filename, 'public');

                $data[$field] = $path;
                $data[$field . '_original'] = $originalName;
                $data[$field . '_size'] = $file->getSize();
                $data[$field . '_uploaded_at'] = now();
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

                // Delete old file if exists
                if ($dokumen->$field && Storage::disk('public')->exists($dokumen->$field)) {
                    Storage::disk('public')->delete($dokumen->$field);
                }

                // Generate unique filename
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filename = $field . '_' . $dokumen->user_id . '_' . time() . '.' . $extension;

                // Store file
                $path = $file->storeAs('dokumen/' . $dokumen->user_id, $filename, 'public');

                $data[$field] = $path;
                $data[$field . '_original'] = $originalName;
                $data[$field . '_size'] = $file->getSize();
                $data[$field . '_uploaded_at'] = now();
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
            if ($dokumen->$field && Storage::disk('public')->exists($dokumen->$field)) {
                Storage::disk('public')->delete($dokumen->$field);
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

        $filePath = storage_path('app/public/' . $dokumen->$field);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server.');
        }

        $originalName = $dokumen->{$field . '_original'} ?? 'dokumen.' . pathinfo($filePath, PATHINFO_EXTENSION);

        return response()->download($filePath, $originalName);
    }
}
