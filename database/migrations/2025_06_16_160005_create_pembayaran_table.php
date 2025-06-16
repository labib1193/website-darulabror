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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('bukti_pembayaran')->nullable(); // File path untuk bukti transfer
            $table->decimal('nominal', 10, 2); // Nominal transfer
            $table->date('tanggal_transfer'); // Tanggal transfer
            $table->string('bank_pengirim'); // Bank pengirim
            $table->string('nama_pengirim'); // Nama pengirim
            $table->enum('status_verifikasi', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('keterangan')->nullable(); // Keterangan admin
            $table->string('bukti_pembayaran_original')->nullable(); // Nama file asli
            $table->timestamp('bukti_pembayaran_uploaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
