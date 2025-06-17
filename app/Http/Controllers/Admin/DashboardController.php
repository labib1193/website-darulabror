<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Dokumen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk dashboard
        $totalPendaftar = User::where('role', 'user')->count();
        $totalPembayaranLunas = Pembayaran::where('status_verifikasi', 'approved')->count();
        $totalPembayaranPending = Pembayaran::where('status_verifikasi', 'pending')->count();
        $totalDokumenBelumLengkap = Dokumen::where('status_verifikasi', 'pending')->count();

        // Pendaftar terbaru (5 terakhir)
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'totalPembayaranLunas',
            'totalPembayaranPending',
            'totalDokumenBelumLengkap',
            'recentUsers'
        ));
    }
}
