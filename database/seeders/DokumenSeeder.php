<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            // Create dokumen record for each user with empty fields
            \App\Models\Dokumen::create([
                'user_id' => $user->id,
                'status_verifikasi' => 'pending',
            ]);
        }
    }
}
