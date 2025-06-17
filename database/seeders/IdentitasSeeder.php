<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Identitas;

class IdentitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user test jika belum ada
        $users = [
            [
                'name' => 'Ahmad Santri',
                'email' => 'santri@test.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Fatimah Santriwati',
                'email' => 'santriwati@test.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ],
            [
                'name' => 'Muhammad Hakim',
                'email' => 'hakim@test.com',
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            // Buat data identitas jika belum ada
            if (!$user->identitas) {
                Identitas::create([
                    'user_id' => $user->id,
                    'no_kk' => '123456789012345' . ($user->id % 10),
                    'nik' => '987654321012345' . ($user->id % 10),
                    'tempat_lahir' => 'Purwokerto',
                    'tanggal_lahir' => '2000-0' . ($user->id % 9 + 1) . '-15',
                    'usia' => 24 + $user->id,
                    'jenis_kelamin' => $user->id % 2 == 0 ? 'Perempuan' : 'Laki-laki',
                    'anak_ke' => $user->id % 3 + 1,
                    'jumlah_saudara' => $user->id % 4 + 1,
                    'tinggal_bersama' => 'Orangtua',
                    'pendidikan_terakhir' => 'SMA/MA',
                    'pekerjaan' => $user->id % 2 == 0 ? 'Mahasiswa' : 'Karyawan Swasta',
                    'no_hp' => '08123456789' . ($user->id % 10),
                    'provinsi' => 'Jawa Tengah',
                    'kabupaten' => 'Banyumas',
                    'kecamatan' => 'Purwokerto Utara',
                    'desa' => 'Karangwangkal',
                    'alamat_lengkap' => 'Jl. Contoh No. ' . (100 + $user->id) . ', RT 01/RW 02',
                    'kode_pos' => '53116',
                    'status_verifikasi' => $user->id % 3 == 0 ? 'terverifikasi' : ($user->id % 2 == 0 ? 'pending' : 'ditolak')
                ]);
            }
        }
    }
}
