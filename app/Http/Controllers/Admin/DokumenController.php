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
            'foto_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_sehat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
        ]);

        $data = ['user_id' => $request->user_id, 'status_verifikasi' => $request->status_verifikasi];

        // Handle file uploads
        $fileFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $data[$field] = $file->store('dokumen', 'public');
                $data[$field . '_original'] = $file->getClientOriginalName();
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
            'foto_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_sehat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'foto_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'catatan_verifikasi' => 'nullable|string',
        ]);

        $data = $request->only(['status_verifikasi', 'catatan_verifikasi']);

        // Handle file uploads
        $fileFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old file if exists
                if ($dokumen->$field) {
                    Storage::disk('public')->delete($dokumen->$field);
                }

                $file = $request->file($field);
                $data[$field] = $file->store('dokumen', 'public');
                $data[$field . '_original'] = $file->getClientOriginalName();
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
            if ($dokumen->$field) {
                Storage::disk('public')->delete($dokumen->$field);
            }
        }

        $dokumen->delete();
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
