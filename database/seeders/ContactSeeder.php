<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'nama' => 'Ahmad Santoso',
                'email' => 'ahmad.santoso@email.com',
                'pesan' => 'Assalamualaikum, saya tertarik untuk mendaftarkan anak saya di Pondok Pesantren Darul Abror. Bisakah saya mendapatkan informasi lebih detail mengenai program pendidikan dan biaya yang diperlukan? Terima kasih.',
                'status' => 'unread',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'nama' => 'Siti Fatimah',
                'email' => 'siti.fatimah@gmail.com',
                'pesan' => 'Selamat siang, saya ingin menanyakan tentang fasilitas asrama di pondok pesantren. Apakah tersedia asrama untuk santri putri? Dan bagaimana sistem pembinaan akhlak yang diterapkan?',
                'status' => 'read',
                'read_at' => Carbon::now()->subDay(),
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDay(),
            ],
            [
                'nama' => 'Muhammad Rizki',
                'email' => 'rizki.muhammad@yahoo.com',
                'pesan' => 'Saya alumni pondok pesantren lain dan ingin melanjutkan tahfidz di Darul Abror. Apakah ada program khusus untuk santri pindahan? Bagaimana prosedur pendaftarannya?',
                'status' => 'unread',
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(5),
            ],
            [
                'nama' => 'Aminah Zahra',
                'email' => 'aminah.zahra@email.com',
                'pesan' => 'Masya Allah, website pondok pesantren sangat informatif. Saya sebagai calon wali santri merasa terbantu dengan informasi yang lengkap. Semoga Darul Abror semakin berkembang dan mencetak generasi Qur\'ani yang berkualitas.',
                'status' => 'read',
                'read_at' => Carbon::now()->subHours(2),
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subHours(2),
            ],
            [
                'nama' => 'Budi Hartono',
                'email' => 'budi.hartono@company.com',
                'pesan' => 'Saya ingin menyampaikan apresiasi atas kualitas lulusan Darul Abror. Beberapa karyawan di perusahaan kami yang berlatar belakang dari pondok ini memiliki akhlak dan etos kerja yang sangat baik. Barakallahu fiikum.',
                'status' => 'unread',
                'created_at' => Carbon::now()->subHours(1),
                'updated_at' => Carbon::now()->subHours(1),
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
