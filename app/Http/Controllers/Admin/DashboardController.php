<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Dokumen;
use App\Models\Identitas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik untuk dashboard
        $totalPendaftar = User::where('role', 'user')->count();
        $totalIdentitas = Identitas::count();
        $identitasTerverifikasi = Identitas::where('status_verifikasi', 'terverifikasi')->count();
        $identitasPending = Identitas::where('status_verifikasi', 'pending')->count();
        $totalPembayaran = Pembayaran::count();
        $pembayaranTerverifikasi = Pembayaran::where('status_verifikasi', 'approved')->count();
        $pembayaranPending = Pembayaran::where('status_verifikasi', 'pending')->count();

        $totalDokumen = Dokumen::count();
        $dokumenTerverifikasi = Dokumen::where('status_verifikasi', 'terverifikasi')->count();
        $dokumenPending = Dokumen::where('status_verifikasi', 'pending')->count();

        // Pendaftar terbaru dengan data identitas
        $recentUsers = User::where('role', 'user')
            ->with('identitas')
            ->latest()
            ->take(8)
            ->get();

        // Data untuk chart
        $chartData = [
            'identitas' => [
                'terverifikasi' => $identitasTerverifikasi,
                'pending' => $identitasPending,
                'ditolak' => Identitas::where('status_verifikasi', 'ditolak')->count()
            ],
            'pembayaran' => [
                'lunas' => $pembayaranTerverifikasi,
                'pending' => $pembayaranPending,
                'gagal' => Pembayaran::where('status_verifikasi', 'rejected')->count()
            ]
        ];

        return view('admin.dashboard', compact(
            'totalPendaftar',
            'totalIdentitas',
            'identitasTerverifikasi',
            'identitasPending',
            'totalPembayaran',
            'pembayaranTerverifikasi',
            'pembayaranPending',
            'totalDokumen',
            'dokumenTerverifikasi',
            'dokumenPending',
            'recentUsers',
            'chartData'
        ));
    }
}
