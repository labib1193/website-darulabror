<?php

/**
 * Stress test for payment code generation uniqueness
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;

echo "Stress testing payment code generation...\n";

// Get a test user
$testUser = User::first();
if (!$testUser) {
    echo "❌ No users found in database. Please create a user first.\n";
    exit(1);
}

$codes = [];
$duplicates = 0;

// Start a transaction for cleanup
DB::beginTransaction();

try {
    $startTime = microtime(true);

    // Test with multiple payment types to simulate real usage
    $paymentTypes = ['spp_bulanan', 'ujian', 'seragam', 'pendaftaran'];

    for ($i = 0; $i < 100; $i++) {
        $jenis = $paymentTypes[$i % count($paymentTypes)];

        try {
            $pembayaran = Pembayaran::create([
                'user_id' => $testUser->id,
                'kode_pembayaran' => Pembayaran::generateKodePembayaran($jenis),
                'jenis_pembayaran' => $jenis,
                'jumlah_tagihan' => 300000,
                'deskripsi' => 'Stress test #' . ($i + 1),
                'nominal' => 300000,
                'tanggal_transfer' => now(),
                'bank_pengirim' => 'BRI',
                'nama_pengirim' => 'Test User',
                'status_verifikasi' => 'pending',
                'status_pembayaran' => 'pending',
            ]);

            $code = $pembayaran->kode_pembayaran;

            if (in_array($code, $codes)) {
                $duplicates++;
                echo "❌ DUPLICATE: $code (Type: $jenis)\n";
            } else {
                $codes[] = $code;
                if ($i % 10 == 0) {
                    echo "✅ Batch " . intval($i / 10 + 1) . " completed. Latest code: $code\n";
                }
            }
        } catch (Exception $e) {
            echo "❌ Error creating record #$i: " . $e->getMessage() . "\n";
        }
    }

    $endTime = microtime(true);
    $duration = round($endTime - $startTime, 2);

    echo "\n📊 Stress Test Results:\n";
    echo "Total records created: " . count($codes) . "\n";
    echo "Duplicates found: $duplicates\n";
    echo "Success rate: " . ((count($codes) / 100) * 100) . "%\n";
    echo "Time taken: {$duration} seconds\n";
    echo "Average time per record: " . round($duration / 100, 3) . " seconds\n";

    if ($duplicates === 0) {
        echo "✅ All codes are unique! System is robust.\n";
    } else {
        echo "❌ Found duplicates - system needs improvement\n";
    }
} finally {
    // Always rollback to clean up test data
    DB::rollback();
    echo "\n🧹 Test data cleaned up.\n";
}
