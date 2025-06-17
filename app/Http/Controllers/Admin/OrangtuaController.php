<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orangtua;
use App\Models\User;
use Illuminate\Http\Request;

class OrangtuaController extends Controller
{
    public function index()
    {
        $orangtua = Orangtua::with('user')->latest()->paginate(10);
        return view('admin.orangtua.index', compact('orangtua'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.orangtua.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'no_kk' => 'required|string|max:20',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'no_hp_1' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:255',
            'penghasilan' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'status' => 'required|in:Ayah,Ibu,Kakak,Adik,Paman,Bibi,Kakek,Nenek,Sepupu,Wali',
        ]);

        Orangtua::create($request->all());

        return redirect()->route('admin.orangtua.index')->with('success', 'Data orangtua berhasil ditambahkan.');
    }

    public function show(Orangtua $orangtua)
    {
        return view('admin.orangtua.show', compact('orangtua'));
    }

    public function edit(Orangtua $orangtua)
    {
        $users = User::all();
        return view('admin.orangtua.edit', compact('orangtua', 'users'));
    }

    public function update(Request $request, Orangtua $orangtua)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'no_kk' => 'required|string|max:20',
            'nik' => 'required|string|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'no_hp_1' => 'required|string|max:20',
            'pekerjaan' => 'nullable|string|max:255',
            'penghasilan' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'alamat_lengkap' => 'nullable|string',
            'kode_pos' => 'nullable|string|max:10',
            'status' => 'required|in:Ayah,Ibu,Kakak,Adik,Paman,Bibi,Kakek,Nenek,Sepupu,Wali',
        ]);

        $orangtua->update($request->all());

        return redirect()->route('admin.orangtua.index')->with('success', 'Data orangtua berhasil diupdate.');
    }

    public function destroy(Orangtua $orangtua)
    {
        $orangtua->delete();
        return redirect()->route('admin.orangtua.index')->with('success', 'Data orangtua berhasil dihapus.');
    }
}
