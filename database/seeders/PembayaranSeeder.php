<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pembayaran;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get first user for demo data
        $user = User::first();

        if ($user) {
            // Create sample payment records
            Pembayaran::create([
                'user_id' => $user->id,
                'bukti_pembayaran' => null, // No actual file for seeder
                'nominal' => 500000,
                'tanggal_transfer' => now()->subDays(2),
                'bank_pengirim' => 'BCA',
                'nama_pengirim' => 'John Doe',
                'status_verifikasi' => 'pending',
                'keterangan' => null,
                'bukti_pembayaran_original' => 'bukti_transfer_sample.jpg',
                'bukti_pembayaran_uploaded_at' => now()->subDays(2),
            ]);
        }
    }
}
