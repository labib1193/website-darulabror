<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IdentitasController extends Controller
{
    public function index()
    {
        $identitas = Auth::user()->identitas;

        // Jika user belum memiliki data identitas, buat objek kosong untuk form
        if (!$identitas) {
            $identitas = new Identitas();
        }

        return view('user.identitas', compact('identitas'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_kk' => 'nullable|string|max:20',
            'nik' => 'required|string|max:20|unique:identitas,nik,' . (Auth::user()->identitas->id ?? 'NULL'),
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

        $identitas = Auth::user()->identitas;

        if (!$identitas) {
            $identitas = new Identitas();
            $identitas->user_id = Auth::id();
        }

        // Hitung usia otomatis berdasarkan tanggal lahir
        $tanggal_lahir = Carbon::parse($request->tanggal_lahir);
        $usia = (int) $tanggal_lahir->diffInYears(Carbon::now());

        $identitas->fill($request->all());
        $identitas->usia = $usia;

        // Set status verifikasi default jika data baru atau belum ada status
        if (!$identitas->exists || empty($identitas->status_verifikasi)) {
            $identitas->status_verifikasi = 'pending';
        }

        $identitas->save();

        return redirect()->route('user.identitas')->with('success', 'Data identitas berhasil diperbarui!');
    }
}
