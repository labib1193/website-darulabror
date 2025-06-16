<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'nik' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'anak_ke' => 'nullable|integer|min:1',
            'jumlah_saudara' => 'nullable|integer|min:0',
            'tinggal_bersama' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'no_hp_1' => 'nullable|string|max:20',
            'no_hp_2' => 'nullable|string|max:20',
            'provinsi' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'alamat_lengkap' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        $identitas = Auth::user()->identitas;

        if (!$identitas) {
            $identitas = new Identitas();
            $identitas->user_id = Auth::id();
        }

        $identitas->fill($request->all());
        $identitas->save();

        return redirect()->route('user.identitas')->with('success', 'Data identitas berhasil diperbarui!');
    }
}
