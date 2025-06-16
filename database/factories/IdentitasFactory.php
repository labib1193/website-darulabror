<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Identitas>
 */
class IdentitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tanggalLahir = $this->faker->dateTimeBetween('-25 years', '-15 years');
        $usia = \Carbon\Carbon::parse($tanggalLahir)->age;

        return [
            'no_kk' => $this->faker->numerify('################'), // 16 digit
            'nik' => $this->faker->numerify('################'), // 16 digit
            'tempat_lahir' => $this->faker->randomElement(['Jakarta', 'Purwokerto', 'Semarang', 'Yogyakarta', 'Surabaya', 'Bandung', 'Malang', 'Solo']),
            'tanggal_lahir' => \Carbon\Carbon::parse($tanggalLahir)->format('Y-m-d'),
            'usia' => $usia,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'anak_ke' => $this->faker->numberBetween(1, 5),
            'jumlah_saudara' => $this->faker->numberBetween(1, 8),
            'tinggal_bersama' => $this->faker->randomElement(['Orangtua', 'Wali', 'Saudara', 'Sendiri']),
            'pendidikan_terakhir' => $this->faker->randomElement(['SD/MI', 'SMP/MTs', 'SMA/MA/SMK', 'D3', 'S1']),
            'no_hp_1' => '08' . $this->faker->numerify('##########'),
            'no_hp_2' => $this->faker->optional(0.3)->passthrough('08' . $this->faker->numerify('##########')),
            'provinsi' => $this->faker->randomElement(['Jawa Tengah', 'Jawa Barat', 'Jawa Timur', 'DKI Jakarta', 'DI Yogyakarta']),
            'kabupaten' => $this->faker->randomElement(['Banyumas', 'Purbalingga', 'Cilacap', 'Kebumen', 'Purworejo', 'Magelang']),
            'kecamatan' => $this->faker->randomElement(['Purwokerto Utara', 'Purwokerto Selatan', 'Purwokerto Barat', 'Purwokerto Timur', 'Sokaraja', 'Kembaran']),
            'alamat_lengkap' => $this->faker->address . ', RT ' . $this->faker->numberBetween(1, 15) . '/RW ' . $this->faker->numberBetween(1, 10),
            'kode_pos' => $this->faker->randomElement(['53116', '53117', '53118', '53119', '53121', '53122']),
        ];
    }
}
