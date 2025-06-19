<?php

/**
 * Simple test script to verify payment code generation uniqueness
 * Run this with: php test_payment_code_generation.php
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;

echo "Testing payment code generation with actual record creation...\n";

// Get a test user (first user in database)
$testUser = User::first();
if (!$testUser) {
    echo "❌ No users found in database. Please create a user first.\n";
    exit(1);
}

// Test concurrent code generation with actual record creation
$codes = [];
$duplicates = 0;
$createdRecords = [];

// Start a transaction for cleanup
DB::beginTransaction();

try {
    // Simulate concurrent requests by creating actual payment records
    for ($i = 0; $i < 20; $i++) {
        try {
            $pembayaran = Pembayaran::create([
                'user_id' => $testUser->id,
                'kode_pembayaran' => Pembayaran::generateKodePembayaran('spp_bulanan'),
                'jenis_pembayaran' => 'spp_bulanan',
                'jumlah_tagihan' => 300000,
                'deskripsi' => 'Test payment #' . ($i + 1),
                'nominal' => 300000,
                'tanggal_transfer' => now(),
                'bank_pengirim' => 'BRI',
                'nama_pengirim' => 'Test User',
                'status_verifikasi' => 'pending',
                'status_pembayaran' => 'pending',
            ]);

            $code = $pembayaran->kode_pembayaran;
            $createdRecords[] = $pembayaran->id;

            if (in_array($code, $codes)) {
                $duplicates++;
                echo "DUPLICATE FOUND: $code\n";
            } else {
                $codes[] = $code;
                echo "Generated unique code: $code\n";
            }
        } catch (Exception $e) {
            echo "Error creating record #$i: " . $e->getMessage() . "\n";
        }
    }

    // Test results
    echo "\nTest Results:\n";
    echo "Total codes generated: " . count($codes) . "\n";
    echo "Duplicates found: $duplicates\n";
    echo "Success rate: " . ((count($codes) / 20) * 100) . "%\n";

    if ($duplicates === 0) {
        echo "✅ All codes are unique!\n";
    } else {
        echo "❌ Found duplicates - need further improvement\n";
    }
} finally {
    // Always rollback to clean up test data
    DB::rollback();
    echo "\nTest data rolled back.\n";
}
