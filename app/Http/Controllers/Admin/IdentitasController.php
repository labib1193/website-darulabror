<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;

class IdentitasController extends Controller
{
    public function index()
    {
        $identitas = Identitas::with('user')->latest()->paginate(10);
        return view('admin.identitas.index', compact('identitas'));
    }

    public function create()
    {
        return view('admin.identitas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'nik' => 'required|string|max:16|unique:identitas',
        ]);

        Identitas::create($request->all());

        return redirect()->route('admin.identitas.index')->with('success', 'Data identitas berhasil ditambahkan.');
    }

    public function show(Identitas $identitas)
    {
        return view('admin.identitas.show', compact('identitas'));
    }

    public function edit(Identitas $identitas)
    {
        return view('admin.identitas.edit', compact('identitas'));
    }

    public function update(Request $request, Identitas $identitas)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'nik' => 'required|string|max:16|unique:identitas,nik,' . $identitas->id,
        ]);

        $identitas->update($request->all());

        return redirect()->route('admin.identitas.index')->with('success', 'Data identitas berhasil diupdate.');
    }

    public function destroy(Identitas $identitas)
    {
        $identitas->delete();
        return redirect()->route('admin.identitas.index')->with('success', 'Data identitas berhasil dihapus.');
    }
}
