<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->string('kode_pembayaran')->unique()->after('id');
            $table->enum('jenis_pembayaran', [
                'pendaftaran',
                'spp_bulanan',
                'ujian',
                'seragam',
                'kegiatan',
                'lainnya'
            ])->default('pendaftaran')->after('user_id');
            $table->decimal('jumlah_tagihan', 15, 2)->default(500000)->after('jenis_pembayaran');
            $table->text('deskripsi')->nullable()->after('jumlah_tagihan');
            $table->enum('status_pembayaran', [
                'belum_bayar',
                'pending',
                'lunas',
                'gagal'
            ])->default('belum_bayar')->after('status_verifikasi');
            $table->timestamp('batas_pembayaran')->nullable()->after('tanggal_transfer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn([
                'kode_pembayaran',
                'jenis_pembayaran',
                'jumlah_tagihan',
                'deskripsi',
                'status_pembayaran',
                'batas_pembayaran'
            ]);
        });
    }
};
