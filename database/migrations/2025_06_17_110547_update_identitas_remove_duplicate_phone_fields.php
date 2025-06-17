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
            // Rename no_hp_1 to no_hp
            $table->renameColumn('no_hp_1', 'no_hp');

            // Drop no_hp_2 column
            $table->dropColumn('no_hp_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('identitas', function (Blueprint $table) {
            // Rename back no_hp to no_hp_1
            $table->renameColumn('no_hp', 'no_hp_1');

            // Add back no_hp_2 column
            $table->string('no_hp_2')->nullable()->after('no_hp_1');
        });
    }
};
