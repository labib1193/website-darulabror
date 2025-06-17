<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orangtua;
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
        return view('admin.orangtua.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|numeric',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|numeric',
            'alamat_orangtua' => 'required|string',
            'no_telepon_orangtua' => 'required|string|max:15',
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
        return view('admin.orangtua.edit', compact('orangtua'));
    }

    public function update(Request $request, Orangtua $orangtua)
    {
        $request->validate([
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'penghasilan_ayah' => 'required|numeric',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'penghasilan_ibu' => 'required|numeric',
            'alamat_orangtua' => 'required|string',
            'no_telepon_orangtua' => 'required|string|max:15',
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
