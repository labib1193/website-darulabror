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
        $dokumenTerverifikasi = Dokumen::where('status_verifikasi', 'approved')->count();
        $dokumenPending = Dokumen::where('status_verifikasi', 'pending')->count();

        // Tambahan variabel yang dibutuhkan di view
        $totalDokumenBelumLengkap = Dokumen::where('status_verifikasi', 'pending')
            ->orWhere('status_verifikasi', 'rejected')
            ->orWhereNull('status_verifikasi')
            ->count();        // Pendaftar terbaru dengan data identitas
        $recentUsers = User::where('role', 'user')
            ->with('identitas')
            ->latest()
            ->take(8)
            ->get();

        // Aktivitas terbaru untuk timeline
        $recentActivities = collect();

        // User baru mendaftar (7 hari terakhir)
        $newUsers = User::where('role', 'user')
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->take(3)
            ->get();

        foreach ($newUsers as $user) {
            $recentActivities->push([
                'type' => 'user_register',
                'user' => $user,
                'time' => $user->created_at,
                'icon' => 'fas fa-user bg-info',
                'title' => $user->name . ' melakukan pendaftaran',
                'description' => 'Calon santri baru telah mendaftar dan mengisi data identitas.'
            ]);
        }

        // Pembayaran terbaru (7 hari terakhir)
        $recentPayments = Pembayaran::with('user')
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->take(3)
            ->get();

        foreach ($recentPayments as $payment) {
            $recentActivities->push([
                'type' => 'payment',
                'user' => $payment->user,
                'time' => $payment->created_at,
                'icon' => 'fas fa-money-bill-wave bg-success',
                'title' => $payment->user->name . ' melakukan pembayaran',
                'description' => 'Pembayaran ' . $payment->jenis_pembayaran_label . ' sebesar Rp ' . number_format($payment->nominal, 0, ',', '.') . ' telah diterima.'
            ]);
        }

        // Sort aktivitas berdasarkan waktu
        $recentActivities = $recentActivities->sortByDesc('time')->take(5);

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
            'totalDokumenBelumLengkap',
            'recentUsers',
            'recentActivities',
            'chartData'
        ));
    }
}
