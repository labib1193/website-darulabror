<?php

// Test script untuk memverifikasi struktur identitas
require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use App\Models\Identitas;

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Test Struktur Identitas ===\n";

try {
    // Test 1: Cek apakah kolom status_verifikasi ada
    $columns = DB::select("SHOW COLUMNS FROM identitas LIKE 'status_verifikasi'");
    if (count($columns) > 0) {
        echo "✅ Kolom status_verifikasi ada\n";
        echo "   Type: " . $columns[0]->Type . "\n";
        echo "   Default: " . $columns[0]->Default . "\n";
    } else {
        echo "❌ Kolom status_verifikasi tidak ada\n";
    }

    // Test 2: Cek apakah kolom no_hp ada (bukan no_hp_1 atau no_hp_2)
    $no_hp = DB::select("SHOW COLUMNS FROM identitas LIKE 'no_hp'");
    $no_hp_1 = DB::select("SHOW COLUMNS FROM identitas LIKE 'no_hp_1'");
    $no_hp_2 = DB::select("SHOW COLUMNS FROM identitas LIKE 'no_hp_2'");

    if (count($no_hp) > 0) {
        echo "✅ Kolom no_hp ada\n";
    } else {
        echo "❌ Kolom no_hp tidak ada\n";
    }

    if (count($no_hp_1) == 0) {
        echo "✅ Kolom no_hp_1 sudah dihapus\n";
    } else {
        echo "❌ Kolom no_hp_1 masih ada\n";
    }

    if (count($no_hp_2) == 0) {
        echo "✅ Kolom no_hp_2 sudah dihapus\n";
    } else {
        echo "❌ Kolom no_hp_2 masih ada\n";
    }

    // Test 3: Cek model fillable
    $identitas = new Identitas();
    $fillable = $identitas->getFillable();

    if (in_array('status_verifikasi', $fillable)) {
        echo "✅ status_verifikasi ada di fillable model\n";
    } else {
        echo "❌ status_verifikasi tidak ada di fillable model\n";
    }

    if (in_array('no_hp', $fillable)) {
        echo "✅ no_hp ada di fillable model\n";
    } else {
        echo "❌ no_hp tidak ada di fillable model\n";
    }

    echo "\n=== Test Selesai ===\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
