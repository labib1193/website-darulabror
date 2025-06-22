<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\Pembayaran;
use App\Models\Identitas;
use App\Models\Orangtua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Menghitung total dokumen yang sudah diupload
        $dokumen = Dokumen::where('user_id', $user->id)->first();
        $totalDokumen = 0;
        if ($dokumen) {
            $dokumenFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];
            foreach ($dokumenFields as $field) {
                if (!empty($dokumen->$field)) {
                    $totalDokumen++;
                }
            }
        }        // Menghitung pembayaran yang sudah selesai (status_verifikasi = 'approved')
        $pembayaranSelesai = Pembayaran::where('user_id', $user->id)
            ->where('status_verifikasi', 'approved')
            ->count();

        // Menghitung persentase kelengkapan data
        $dataCompletion = $this->calculateDataCompletion($user->id);

        // Menghitung data pendukung untuk widget alternatif (mengganti notifikasi)
        $statusVerifikasi = $this->getVerificationStatus($user->id);

        return view('user.dashboard', compact(
            'totalDokumen',
            'pembayaranSelesai',
            'dataCompletion',
            'statusVerifikasi'
        ));
    }

    private function calculateDataCompletion($userId)
    {
        $completionPercentage = 0;
        $totalSteps = 4; // Identitas, Orangtua, Dokumen, Pembayaran
        $completedSteps = 0;

        // Cek kelengkapan data identitas
        $identitas = Identitas::where('user_id', $userId)->first();
        if ($identitas) {
            $requiredFields = ['nik', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_hp', 'alamat_lengkap'];
            $filledFields = 0;
            foreach ($requiredFields as $field) {
                if (!empty($identitas->$field)) {
                    $filledFields++;
                }
            }
            if ($filledFields >= count($requiredFields) * 0.8) { // 80% field terisi
                $completedSteps++;
            }
        }

        // Cek kelengkapan data orangtua
        $orangtua = Orangtua::where('user_id', $userId)->count();
        if ($orangtua >= 1) { // Minimal ada 1 data orangtua
            $completedSteps++;
        }

        // Cek kelengkapan dokumen
        $dokumen = Dokumen::where('user_id', $userId)->first();
        if ($dokumen) {
            $dokumenFields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];
            $uploadedDocs = 0;
            foreach ($dokumenFields as $field) {
                if (!empty($dokumen->$field)) {
                    $uploadedDocs++;
                }
            }
            if ($uploadedDocs >= 3) { // Minimal 3 dokumen terupload
                $completedSteps++;
            }
        }        // Cek kelengkapan pembayaran
        $pembayaran = Pembayaran::where('user_id', $userId)
            ->where('status_verifikasi', 'approved')
            ->count();
        if ($pembayaran > 0) {
            $completedSteps++;
        }

        $completionPercentage = ($completedSteps / $totalSteps) * 100;

        return round($completionPercentage);
    }

    private function getVerificationStatus($userId)
    {
        $verifiedCount = 0;
        $totalItems = 3; // Identitas, Dokumen, Pembayaran

        // Cek status verifikasi identitas
        $identitas = Identitas::where('user_id', $userId)->first();
        if ($identitas && $identitas->status_verifikasi === 'terverifikasi') {
            $verifiedCount++;
        }        // Cek status verifikasi dokumen
        $dokumen = Dokumen::where('user_id', $userId)->first();
        if ($dokumen && $dokumen->status_verifikasi === 'approved') {
            $verifiedCount++;
        }

        // Cek status verifikasi pembayaran
        $pembayaranVerified = Pembayaran::where('user_id', $userId)
            ->where('status_verifikasi', 'approved')
            ->count();
        if ($pembayaranVerified > 0) {
            $verifiedCount++;
        }

        return [
            'verified' => $verifiedCount,
            'total' => $totalItems,
            'status' => $verifiedCount == $totalItems ? 'Lengkap' : ($verifiedCount > 0 ? 'Sebagian' : 'Belum')
        ];
    }
}
