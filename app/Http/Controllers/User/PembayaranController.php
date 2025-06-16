<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pembayaran = $user->pembayaran()->orderBy('created_at', 'desc')->get();
        $latestPembayaran = $user->latestPembayaran;

        // Status pembayaran berdasarkan pembayaran terakhir
        $statusPembayaran = 'Belum Lunas';
        if ($latestPembayaran && $latestPembayaran->status_verifikasi === 'approved') {
            $statusPembayaran = 'Lunas';
        } elseif ($latestPembayaran && $latestPembayaran->status_verifikasi === 'pending') {
            $statusPembayaran = 'Menunggu Verifikasi';
        } elseif ($latestPembayaran && $latestPembayaran->status_verifikasi === 'rejected') {
            $statusPembayaran = 'Ditolak - Perlu Upload Ulang';
        }

        return view('user.pembayaran', compact('pembayaran', 'latestPembayaran', 'statusPembayaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nominal' => 'required|numeric|min:1',
            'tanggal_transfer' => 'required|date',
            'bank_pengirim' => 'required|string|max:255',
            'nama_pengirim' => 'required|string|max:255',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diupload.',
            'bukti_pembayaran.image' => 'File harus berupa gambar.',
            'bukti_pembayaran.mimes' => 'Format file harus JPG, PNG.',
            'bukti_pembayaran.max' => 'Ukuran file maksimal 2MB.',
            'nominal.required' => 'Nominal transfer harus diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'tanggal_transfer.required' => 'Tanggal transfer harus diisi.',
            'bank_pengirim.required' => 'Bank pengirim harus diisi.',
            'nama_pengirim.required' => 'Nama pengirim harus diisi.',
        ]);

        try {
            $user = Auth::user();

            // Handle file upload
            $file = $request->file('bukti_pembayaran');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('pembayaran', $fileName, 'public');

            // Create pembayaran record
            $pembayaran = Pembayaran::create([
                'user_id' => $user->id,
                'bukti_pembayaran' => $filePath,
                'nominal' => $request->nominal,
                'tanggal_transfer' => $request->tanggal_transfer,
                'bank_pengirim' => $request->bank_pengirim,
                'nama_pengirim' => $request->nama_pengirim,
                'status_verifikasi' => 'pending',
                'bukti_pembayaran_original' => $originalName,
                'bukti_pembayaran_uploaded_at' => now(),
            ]);

            return redirect()->route('user.pembayaran')
                ->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat mengupload bukti pembayaran.')
                ->withInput();
        }
    }

    public function download($id)
    {
        $pembayaran = Pembayaran::where('user_id', Auth::id())->findOrFail($id);

        if (!$pembayaran->bukti_pembayaran || !Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download(
            $pembayaran->bukti_pembayaran,
            $pembayaran->bukti_pembayaran_original
        );
    }

    public function delete($id)
    {
        try {
            $pembayaran = Pembayaran::where('user_id', Auth::id())->findOrFail($id);

            // Only allow deletion if status is pending or rejected
            if (!in_array($pembayaran->status_verifikasi, ['pending', 'rejected'])) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus pembayaran yang sudah disetujui.');
            }

            // Delete file if exists
            if ($pembayaran->bukti_pembayaran && Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
                Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
            }

            $pembayaran->delete();

            return redirect()->route('user.pembayaran')
                ->with('success', 'Data pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data pembayaran.');
        }
    }
}
