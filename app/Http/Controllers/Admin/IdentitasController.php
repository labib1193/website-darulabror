<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentitasController extends Controller
{
    public function index(Request $request)
    {
        $query = Identitas::with('user');

        // Filter berdasarkan status verifikasi
        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        // Filter berdasarkan jenis kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Search berdasarkan nama user atau NIK
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('tempat_lahir', 'like', "%{$search}%");
            });
        }

        $identitas = $query->latest()->paginate(10);

        // Data untuk filter dropdown
        $statusOptions = [
            'pending' => 'Pending',
            'terverifikasi' => 'Terverifikasi',
            'ditolak' => 'Ditolak'
        ];

        $jenisKelaminOptions = [
            'Laki-laki' => 'Laki-laki',
            'Perempuan' => 'Perempuan'
        ];

        return view('admin.identitas.index', compact('identitas', 'statusOptions', 'jenisKelaminOptions'));
    }

    public function create()
    {
        return view('admin.identitas.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'no_kk' => 'nullable|string|max:20',
            'nik' => 'required|string|max:20|unique:identitas',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'anak_ke' => 'nullable|integer|min:1',
            'jumlah_saudara' => 'nullable|integer|min:0',
            'tinggal_bersama' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'no_hp' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        Identitas::create($request->all());

        return redirect()->route('admin.identitas.index')->with('success', 'Data identitas berhasil ditambahkan.');
    }
    public function show(Identitas $identitas)
    {
        $identitas->load(['user', 'verifiedBy']);
        return view('admin.identitas.show', compact('identitas'));
    }

    public function edit(Identitas $identitas)
    {
        return view('admin.identitas.edit', compact('identitas'));
    }
    public function update(Request $request, Identitas $identitas)
    {
        $request->validate([
            'no_kk' => 'nullable|string|max:20',
            'nik' => 'required|string|max:20|unique:identitas,nik,' . $identitas->id,
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'usia' => 'nullable|integer|min:1|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'anak_ke' => 'nullable|integer|min:1',
            'jumlah_saudara' => 'nullable|integer|min:0',
            'tinggal_bersama' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'no_hp' => 'required|string|max:20',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'alamat_lengkap' => 'required|string',
            'kode_pos' => 'nullable|string|max:10',
            'status_verifikasi' => 'nullable|in:pending,terverifikasi,ditolak',
        ]);

        // Menyiapkan data untuk update dengan status verifikasi
        $data = $request->all();

        // Jika status verifikasi berubah menjadi terverifikasi
        if ($request->status_verifikasi == 'terverifikasi' && $identitas->status_verifikasi != 'terverifikasi') {
            $data['verified_at'] = now();
            $data['verified_by'] = Auth::id();
        }

        $identitas->update($data);

        return redirect()->route('admin.identitas.index')->with('success', 'Data identitas berhasil diupdate.');
    }

    public function destroy(Identitas $identitas)
    {
        $identitas->delete();
        return redirect()->route('admin.identitas.index')->with('success', 'Data identitas berhasil dihapus.');
    }

    public function updateStatus(Request $request, Identitas $identitas)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:Belum Diverifikasi,pending,terverifikasi,ditolak',
            'catatan_admin' => 'nullable|string|max:500'
        ]);

        $identitas->update([
            'status_verifikasi' => $request->status_verifikasi,
            'catatan_admin' => $request->catatan_admin,
            'verified_at' => $request->status_verifikasi == 'terverifikasi' ? now() : null,
            'verified_by' => $request->status_verifikasi == 'terverifikasi' ? Auth::id() : null,
        ]);

        $statusText = [
            'Belum Diverifikasi' => 'belum diverifikasi',
            'pending' => 'pending',
            'terverifikasi' => 'terverifikasi',
            'ditolak' => 'ditolak'
        ];

        return redirect()->back()->with(
            'success',
            "Status identitas berhasil diubah menjadi " . $statusText[$request->status_verifikasi] . "."
        );
    }
}
