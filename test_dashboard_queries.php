<?php

require_once 'vendor/autoload.php';

use App\Models\Pembayaran;
use App\Models\Identitas;

// Test queries yang digunakan di dashboard
echo "Testing dashboard queries...\n";

try {
    echo "Total Pembayaran: " . Pembayaran::count() . "\n";
    echo "Pembayaran Approved: " . Pembayaran::where('status_verifikasi', 'approved')->count() . "\n";
    echo "Pembayaran Pending: " . Pembayaran::where('status_verifikasi', 'pending')->count() . "\n";
    echo "Pembayaran Rejected: " . Pembayaran::where('status_verifikasi', 'rejected')->count() . "\n";

    echo "Total Identitas: " . Identitas::count() . "\n";
    echo "Identitas Terverifikasi: " . Identitas::where('status_verifikasi', 'terverifikasi')->count() . "\n";
    echo "Identitas Pending: " . Identitas::where('status_verifikasi', 'pending')->count() . "\n";
    echo "Identitas Ditolak: " . Identitas::where('status_verifikasi', 'ditolak')->count() . "\n";

    echo "All queries executed successfully!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
