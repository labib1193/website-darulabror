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
        Schema::table('identitas', function (Blueprint $table) {
            // Tambah kolom pekerjaan setelah pendidikan_terakhir
            $table->string('pekerjaan', 100)->nullable()->after('pendidikan_terakhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas', function (Blueprint $table) {
            $table->dropColumn('pekerjaan');
        });
    }
};
