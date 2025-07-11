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
        Schema::table('users', function (Blueprint $table) {
            $table->text('profile_photo')->nullable()->after('email'); // Changed to text to store Cloudinary URLs
            $table->string('profile_photo_original')->nullable()->after('profile_photo');
            $table->timestamp('profile_photo_uploaded_at')->nullable()->after('profile_photo_original');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_photo', 'profile_photo_original', 'profile_photo_uploaded_at']);
        });
    }
};
