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
            // Add index for better performance on kode_pembayaran lookups
            $table->index('kode_pembayaran', 'idx_pembayaran_kode_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Drop the index
            $table->dropIndex('idx_pembayaran_kode_pembayaran');
        });
    }
};
