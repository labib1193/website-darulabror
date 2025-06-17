<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('user')->latest()->paginate(10);
        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        return view('admin.pembayaran.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nominal' => 'required|numeric|min:0',
            'bank_pengirim' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'tanggal_transfer' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Pembayaran::create($request->all());

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil ditambahkan.');
    }

    public function show(Pembayaran $pembayaran)
    {
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        return view('admin.pembayaran.edit', compact('pembayaran'));
    }
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'nominal' => 'required|numeric|min:0',
            'bank_pengirim' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
            'status_verifikasi' => 'required|in:pending,approved,rejected',
            'tanggal_transfer' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil diupdate.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('admin.pembayaran.index')->with('success', 'Data pembayaran berhasil dihapus.');
    }
}
