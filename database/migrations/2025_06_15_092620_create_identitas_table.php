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
        Schema::create('identitas', function (Blueprint $table) {
            $table->id();

            // Foreign key ke tabel users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data Kartu Keluarga dan NIK
            $table->string('no_kk', 16);
            $table->string('nik', 16)->unique();

            // Data Kelahiran
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->integer('usia')->nullable()->comment('Dihitung otomatis dari tanggal lahir');

            // Data Personal
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('anak_ke');
            $table->integer('jumlah_saudara');

            // Data Sosial dan Pendidikan
            $table->string('tinggal_bersama', 100);
            $table->string('pendidikan_terakhir', 100);

            // Data Kontak
            $table->string('no_hp_1', 15);
            $table->string('no_hp_2', 15)->nullable();

            // Data Wilayah
            $table->string('provinsi', 100);
            $table->string('kabupaten', 100);
            $table->string('kecamatan', 100);

            // Data Alamat
            $table->text('alamat_lengkap');
            $table->string('kode_pos', 10);

            $table->timestamps();

            // Index untuk pencarian yang lebih cepat
            $table->index('nik');
            $table->index('no_kk');
            $table->index(['provinsi', 'kabupaten', 'kecamatan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas');
    }
};
