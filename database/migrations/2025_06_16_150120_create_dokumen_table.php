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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Dokumen paths
            $table->string('foto_ktp')->nullable();
            $table->string('foto_ijazah')->nullable();
            $table->string('surat_sehat')->nullable();
            $table->string('foto_kk')->nullable();
            $table->string('pas_foto')->nullable();

            // Dokumen original names
            $table->string('foto_ktp_original')->nullable();
            $table->string('foto_ijazah_original')->nullable();
            $table->string('surat_sehat_original')->nullable();
            $table->string('foto_kk_original')->nullable();
            $table->string('pas_foto_original')->nullable();

            // File sizes (in bytes)
            $table->integer('foto_ktp_size')->nullable();
            $table->integer('foto_ijazah_size')->nullable();
            $table->integer('surat_sehat_size')->nullable();
            $table->integer('foto_kk_size')->nullable();
            $table->integer('pas_foto_size')->nullable();

            // Upload timestamps
            $table->timestamp('foto_ktp_uploaded_at')->nullable();
            $table->timestamp('foto_ijazah_uploaded_at')->nullable();
            $table->timestamp('surat_sehat_uploaded_at')->nullable();
            $table->timestamp('foto_kk_uploaded_at')->nullable();
            $table->timestamp('pas_foto_uploaded_at')->nullable();

            // Status verifikasi
            $table->enum('status_verifikasi', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan_verifikasi')->nullable();

            $table->timestamps();

            // Index untuk performa
            $table->index(['user_id', 'status_verifikasi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
