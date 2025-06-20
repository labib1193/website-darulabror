<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Ubah kolom jenis_pembayaran ke VARCHAR sementara
        DB::statement('ALTER TABLE pembayaran MODIFY COLUMN jenis_pembayaran VARCHAR(50)');

        // Step 2: Update data yang ada dari 'ujian' ke 'kitab' (opsional - sesuai kebutuhan)
        // DB::statement("UPDATE pembayaran SET jenis_pembayaran = 'kitab' WHERE jenis_pembayaran = 'ujian'");

        // Step 3: Ubah kembali ke ENUM dengan nilai yang diperbarui
        DB::statement("ALTER TABLE pembayaran MODIFY COLUMN jenis_pembayaran ENUM(
            'pendaftaran',
            'spp_bulanan',
            'seragam',
            'ujian',
            'kitab',
            'kegiatan',
            'lainnya'
        ) DEFAULT 'pendaftaran'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback ke ENUM semula tanpa 'kitab'
        DB::statement("ALTER TABLE pembayaran MODIFY COLUMN jenis_pembayaran ENUM(
            'pendaftaran',
            'spp_bulanan',
            'ujian',
            'seragam',
            'kegiatan',
            'lainnya'
        ) DEFAULT 'pendaftaran'");
    }
};
