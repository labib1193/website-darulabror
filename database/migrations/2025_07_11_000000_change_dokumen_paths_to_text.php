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
        Schema::table('dokumen', function (Blueprint $table) {
            // Change document path columns to text to accommodate Cloudinary URLs
            $table->text('foto_ktp')->nullable()->change();
            $table->text('foto_ijazah')->nullable()->change();
            $table->text('surat_sehat')->nullable()->change();
            $table->text('foto_kk')->nullable()->change();
            $table->text('pas_foto')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen', function (Blueprint $table) {
            // Revert back to string columns
            $table->string('foto_ktp')->nullable()->change();
            $table->string('foto_ijazah')->nullable()->change();
            $table->string('surat_sehat')->nullable()->change();
            $table->string('foto_kk')->nullable()->change();
            $table->string('pas_foto')->nullable()->change();
        });
    }
};
