<?php

/**
 * Check for duplicate payment codes
 */

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

echo "Checking for duplicate payment codes...\n";

$duplicates = Pembayaran::select('kode_pembayaran', DB::raw('COUNT(*) as count'))
    ->groupBy('kode_pembayaran')
    ->having('count', '>', 1)
    ->get();

echo "Found " . $duplicates->count() . " duplicate payment codes\n";

if ($duplicates->count() > 0) {
    echo "Duplicate codes:\n";
    foreach ($duplicates as $duplicate) {
        echo "- Code: {$duplicate->kode_pembayaran} appears {$duplicate->count} times\n";
    }
} else {
    echo "✅ No duplicate payment codes found!\n";
}

// Also check the total count
$total = Pembayaran::count();
echo "Total payment records: $total\n";
