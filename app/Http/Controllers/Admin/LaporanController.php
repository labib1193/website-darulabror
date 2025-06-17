<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Identitas;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function pendaftar(Request $request)
    {
        $query = User::where('role', 'user');

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $pendaftar = $query->with(['identitas', 'pembayaran'])->latest()->get();

        return view('admin.laporan.pendaftar', compact('pendaftar'));
    }
    public function pembayaran(Request $request)
    {
        $query = Pembayaran::with('user');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_transfer', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_transfer', '<=', $request->end_date);
        }

        $pembayaran = $query->latest()->get();

        // Statistik
        $totalPembayaran = $pembayaran->sum('nominal');
        $totalApproved = $pembayaran->where('status_verifikasi', 'approved')->count();
        $totalPending = $pembayaran->where('status_verifikasi', 'pending')->count();
        $totalRejected = $pembayaran->where('status_verifikasi', 'rejected')->count();

        return view('admin.laporan.pembayaran', compact(
            'pembayaran',
            'totalPembayaran',
            'totalApproved',
            'totalPending',
            'totalRejected'
        ));
    }
}
