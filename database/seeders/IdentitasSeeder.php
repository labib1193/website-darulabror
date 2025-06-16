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
        $user = User::where('email', 'santri@test.com')->first();

        if ($user && !$user->identitas) {
            Identitas::create([
                'user_id' => $user->id,
                'no_kk' => '1234567890123456',
                'nik' => '9876543210123456',
                'tempat_lahir' => 'Purwokerto',
                'tanggal_lahir' => '2000-01-01',
                'usia' => 25,
                'jenis_kelamin' => 'Laki-laki',
                'anak_ke' => 2,
                'jumlah_saudara' => 3,
                'tinggal_bersama' => 'Orangtua',
                'pendidikan_terakhir' => 'SMA/MA',
                'no_hp_1' => '081234567890',
                'no_hp_2' => '085678901234',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Banyumas',
                'kecamatan' => 'Purwokerto Utara',
                'alamat_lengkap' => 'Jl. Contoh No. 123, RT 01/RW 02',
                'kode_pos' => '53116'
            ]);
        }
    }
}
