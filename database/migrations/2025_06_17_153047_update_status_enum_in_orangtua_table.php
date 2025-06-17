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
        // First, modify the enum column to include all new values while keeping old ones temporarily
        DB::statement("ALTER TABLE orangtua MODIFY COLUMN status ENUM('Orangtua', 'Wali', 'Ayah', 'Ibu', 'Kakak', 'Adik', 'Paman', 'Bibi', 'Kakek', 'Nenek', 'Sepupu')");

        // Update existing data - map 'Orangtua' to 'Ayah' by default
        DB::statement("UPDATE orangtua SET status = 'Ayah' WHERE status = 'Orangtua'");

        // Finally, remove the old 'Orangtua' option from enum
        DB::statement("ALTER TABLE orangtua MODIFY COLUMN status ENUM('Ayah', 'Ibu', 'Kakak', 'Adik', 'Paman', 'Bibi', 'Kakek', 'Nenek', 'Sepupu', 'Wali')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the old enum values
        DB::statement("ALTER TABLE orangtua MODIFY COLUMN status ENUM('Orangtua', 'Wali', 'Ayah', 'Ibu', 'Kakak', 'Adik', 'Paman', 'Bibi', 'Kakek', 'Nenek', 'Sepupu')");

        // Update existing data back
        DB::statement("UPDATE orangtua SET status = 'Orangtua' WHERE status IN ('Ayah', 'Ibu', 'Kakak', 'Adik', 'Paman', 'Bibi', 'Kakek', 'Nenek', 'Sepupu')");

        // Restore original enum
        DB::statement("ALTER TABLE orangtua MODIFY COLUMN status ENUM('Orangtua', 'Wali')");
    }
};
