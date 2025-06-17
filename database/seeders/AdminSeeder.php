<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat admin default jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@darulabror.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@darulabror.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Buat super admin jika belum ada
        User::firstOrCreate(
            ['email' => 'superadmin@darulabror.com'],
            [
                'name' => 'Super Administrator',
                'email' => 'superadmin@darulabror.com',
                'password' => Hash::make('superadmin123'),
                'role' => 'superadmin',
                'email_verified_at' => now(),
            ]
        );
    }
}
