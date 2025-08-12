<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // 1) Pastikan tipe kolom jadi string(50)
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->string('jenis_pembayaran', 50)->change();
        });

        // 2) Ganti nilai lama 'Ujian' -> 'Kitab'
        DB::table('pembayaran')
            ->where('jenis_pembayaran', 'Ujian')
            ->update(['jenis_pembayaran' => 'Kitab']);

        // 3) (Opsional) Tambah CHECK constraint biar tetap terbatas
        DB::statement("ALTER TABLE pembayaran DROP CONSTRAINT IF EXISTS chk_jenis_pembayaran");
        DB::statement("ALTER TABLE pembayaran
            ADD CONSTRAINT chk_jenis_pembayaran
            CHECK (jenis_pembayaran IN ('Pendaftaran','SPP','Kitab','Donasi'))");
    }

    public function down(): void
    {
        // Balikkan perubahan nilai (opsional)
        DB::table('pembayaran')
            ->where('jenis_pembayaran', 'Kitab')
            ->update(['jenis_pembayaran' => 'Ujian']);

        // Hapus CHECK constraint
        DB::statement("ALTER TABLE pembayaran DROP CONSTRAINT IF EXISTS chk_jenis_pembayaran");
    }
};
