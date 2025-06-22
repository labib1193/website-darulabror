<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        return view('public.berita');
    }

    public function show($slug)
    {
        // Data berita statis untuk demo
        $berita = $this->getBeritaBySlug($slug);

        if (!$berita) {
            abort(404);
        }

        // Berita terkait
        $beritaTerkait = $this->getBeritaTerkait($slug);

        return view('public.berita-detail', compact('berita', 'beritaTerkait'));
    }

    private function getBeritaBySlug($slug)
    {
        $beritaData = [
            'perayaan-maulid-nabi-muhammad-saw' => [
                'id' => 1,
                'slug' => 'perayaan-maulid-nabi-muhammad-saw',
                'judul' => 'Perayaan Maulid Nabi Muhammad SAW di Pondok Pesantren Darul Abror',
                'kategori' => 'Kegiatan Santri',
                'kategori_class' => 'bg-primary',
                'tanggal' => '5 Juni 2025',
                'waktu_baca' => '5 menit baca',
                'gambar' => 'assets/images/public/berita/berita1.jpg',
                'penulis' => 'Tim Media Darul Abror',
                'ringkasan' => 'Pondok Pesantren Darul Abror mengadakan perayaan Maulid Nabi Muhammad SAW dengan berbagai rangkaian kegiatan yang melibatkan seluruh santri dan pengajar.',
                'konten' => [
                    'Pondok Pesantren Darul Abror dengan penuh suka cita mengadakan perayaan Maulid Nabi Muhammad SAW pada tanggal 5 Juni 2025. Acara yang berlangsung meriah ini dihadiri oleh seluruh santri, pengajar, serta masyarakat sekitar yang turut meramaikan peringatan kelahiran Rasulullah SAW.',

                    'Rangkaian acara dimulai sejak pagi hari dengan pembacaan shalawat dan tahlil bersama di masjid utama pondok pesantren. Suasana khusyuk tercipta ketika ratusan suara santri bersatu dalam lantunan dzikir dan pujian kepada Rasulullah SAW.',

                    'Ustadz Ahmad Fauzi, selaku pengasuh pondok pesantren, menyampaikan tausiyah yang menginspirasi tentang akhlak mulia Rasulullah SAW. "Peringatan Maulid ini bukan hanya seremonial, tetapi momentum untuk meneladani sifat-sifat terpuji Nabi Muhammad SAW dalam kehidupan sehari-hari," ujar beliau.',

                    'Acara dilanjutkan dengan berbagai lomba bernuansa Islami seperti lomba hafalan hadits, qiraatul Quran, dan penulisan kaligrafi. Para santri menunjukkan antusiasme tinggi dalam mengikuti setiap perlombaan yang diselenggarakan.',

                    'Puncak acara adalah penampilan tim hadrah dari santri senior yang membawakan shalawat-shalawat pilihan. Irama rebana yang merdu menciptakan atmosfer spiritual yang mendalam, membuat seluruh hadirin terhanyut dalam cinta kepada Rasulullah SAW.',

                    'Kegiatan ini juga dimeriahkan dengan bazaar makanan tradisional yang dikelola oleh santri dan masyarakat sekitar. Hasil dari bazaar ini akan disumbangkan untuk program beasiswa santri kurang mampu.',

                    'Pondok Pesantren Darul Abror berkomitmen untuk terus mengadakan kegiatan-kegiatan yang dapat mempererat tali silaturahmi dan memperkuat nilai-nilai keislaman di kalangan santri dan masyarakat.'
                ],
                'tags' => ['Maulid Nabi', 'Kegiatan Santri', 'Pondok Pesantren', 'Shalawat', 'Hadrah']
            ],
            'santri-juara-mtq-nasional' => [
                'id' => 2,
                'slug' => 'santri-juara-mtq-nasional',
                'judul' => 'Santri Darul Abror Juara MTQ Tingkat Nasional',
                'kategori' => 'Prestasi',
                'kategori_class' => 'bg-success',
                'tanggal' => '4 Juni 2025',
                'waktu_baca' => '3 menit baca',
                'gambar' => 'assets/images/public/berita/berita2.jpg',
                'penulis' => 'Tim Media Darul Abror',
                'ringkasan' => 'Santri Pondok Pesantren Darul Abror berhasil meraih juara 1 dalam Musabaqah Tilawatil Quran tingkat nasional.',
                'konten' => [
                    'Kebanggaan besar menyelimuti Pondok Pesantren Darul Abror setelah salah satu santrinya, Ahmad Rizki Hakim, berhasil meraih juara 1 dalam Musabaqah Tilawatil Quran (MTQ) tingkat nasional yang diselenggarakan di Jakarta.',
                    'Kompetisi yang berlangsung selama 5 hari ini diikuti oleh ratusan peserta terbaik dari seluruh Indonesia. Ahmad Rizki yang merupakan santri kelas 3 Aliyah ini berhasil mengungguli peserta lainnya dengan bacaan Quran yang merdu dan tajwid yang sempurna.',
                    'Prestasi gemilang ini merupakan buah dari latihan intensif yang dilakukan selama berbulan-bulan dibawah bimbingan Ustadz Abdullah Marzuki, pembina tilawah pondok pesantren.',
                    'Kepala Pondok Pesantren, KH. Muhammad Yusuf, menyampaikan rasa syukur dan kebanggaan atas prestasi yang diraih. "Ini adalah bukti bahwa pendidikan Al-Quran di pondok pesantren kami sudah pada jalur yang benar," ujarnya.'
                ],
                'tags' => ['MTQ', 'Prestasi', 'Tilawah', 'Al-Quran', 'Kompetisi']
            ],
            'program-tahfidz-intensif' => [
                'id' => 3,
                'slug' => 'program-tahfidz-intensif',
                'judul' => 'Program Tahfidz Intensif Selama Ramadhan',
                'kategori' => 'Akademik',
                'kategori_class' => 'bg-info',
                'tanggal' => '3 Juni 2025',
                'waktu_baca' => '4 menit baca',
                'gambar' => 'assets/images/public/berita/berita3.jpg',
                'penulis' => 'Tim Media Darul Abror',
                'ringkasan' => 'Pondok Pesantren mengadakan program tahfidz intensif khusus selama bulan Ramadhan untuk meningkatkan hafalan santri.',
                'konten' => [
                    'Bulan Ramadhan tahun ini menjadi momentum spesial bagi santri Pondok Pesantren Darul Abror dengan diluncurkannya program tahfidz intensif yang berlangsung selama 30 hari penuh.',
                    'Program ini dirancang khusus untuk memaksimalkan waktu berkah Ramadhan dalam menghafal Al-Quran. Setiap santri mendapatkan target hafalan tambahan 1 juz selama bulan Ramadhan.',
                    'Kegiatan dimulai setelah shalat Subuh hingga menjelang berbuka puasa, dengan metode pembelajaran yang telah terbukti efektif. Para santri dibimbing oleh para ustadz yang telah hafidz 30 juz.',
                    'Hasil yang dicapai sangat menggembirakan, dengan 85% santri berhasil mencapai target hafalan yang ditetapkan.'
                ],
                'tags' => ['Tahfidz', 'Ramadhan', 'Hafalan', 'Al-Quran', 'Program Intensif']
            ],
            'pendaftaran-santri-baru-2025' => [
                'id' => 4,
                'slug' => 'pendaftaran-santri-baru-2025',
                'judul' => 'Pembukaan Pendaftaran Santri Baru Tahun Ajaran 2025/2026',
                'kategori' => 'Pengumuman',
                'kategori_class' => 'bg-warning',
                'tanggal' => '2 Juni 2025',
                'waktu_baca' => '3 menit baca',
                'gambar' => 'assets/images/public/berita/berita4.jpg',
                'penulis' => 'Panitia Penerimaan Santri Baru',
                'ringkasan' => 'Pondok Pesantren Darul Abror membuka pendaftaran santri baru untuk tahun ajaran 2025/2026.',
                'konten' => [
                    'Pondok Pesantren Darul Abror dengan bangga mengumumkan pembukaan pendaftaran santri baru untuk tahun ajaran 2025/2026. Pendaftaran dibuka mulai tanggal 1 Juni hingga 31 Juli 2025.',
                    'Calon santri dapat mendaftar melalui sistem online di website resmi pondok pesantren atau datang langsung ke sekretariat pendaftaran yang buka setiap hari dari pukul 08.00-16.00 WIB.',
                    'Persyaratan pendaftaran meliputi fotokopi ijazah terakhir, fotokopi KTP/KK, pas foto terbaru, dan surat keterangan sehat dari dokter.',
                    'Tersedia berbagai program pendidikan mulai dari Ibtidaiyah, Tsanawiyah, hingga Aliyah dengan kurikulum yang menggabungkan pendidikan agama dan umum.'
                ],
                'tags' => ['Pendaftaran', 'Santri Baru', 'Tahun Ajaran', 'PPDB', 'Pendidikan']
            ],
            'workshop-entrepreneurship' => [
                'id' => 5,
                'slug' => 'workshop-entrepreneurship',
                'judul' => 'Workshop Entrepreneurship untuk Santri',
                'kategori' => 'Kegiatan Santri',
                'kategori_class' => 'bg-primary',
                'tanggal' => '1 Juni 2025',
                'waktu_baca' => '4 menit baca',
                'gambar' => 'assets/images/public/berita/berita5.jpg',
                'penulis' => 'Tim Media Darul Abror',
                'ringkasan' => 'Workshop kewirausahaan yang fokus pada e-commerce untuk mempersiapkan santri menghadapi era digital.',
                'konten' => [
                    'Pondok Pesantren Darul Abror menggelar workshop entrepreneurship yang dikhususkan untuk para santri kelas akhir. Acara yang berlangsung selama 3 hari ini menghadirkan praktisi bisnis berpengalaman.',
                    'Materi workshop meliputi dasar-dasar kewirausahaan, pemasaran digital, dan praktik langsung membuat toko online. Para santri diajarkan bagaimana memanfaatkan teknologi untuk mengembangkan bisnis.',
                    'Salah satu narasumber, Pak Budi Santoso yang merupakan founder startup sukses, berbagi pengalaman tentang membangun bisnis dari nol hingga berkembang pesat.',
                    'Di akhir workshop, setiap santri diminta membuat proposal bisnis sederhana yang akan dinilai oleh para mentor.'
                ],
                'tags' => ['Workshop', 'Entrepreneurship', 'Digital', 'Bisnis', 'E-commerce']
            ],
            'tim-hadrah-juara-festival' => [
                'id' => 6,
                'slug' => 'tim-hadrah-juara-festival',
                'judul' => 'Tim Hadrah Raih Juara di Festival Seni Islami',
                'kategori' => 'Prestasi',
                'kategori_class' => 'bg-success',
                'tanggal' => '31 Mei 2025',
                'waktu_baca' => '3 menit baca',
                'gambar' => 'assets/images/public/berita/berita6.jpg',
                'penulis' => 'Tim Media Darul Abror',
                'ringkasan' => 'Tim Hadrah Pondok Pesantren Darul Abror berhasil meraih juara 1 dalam Festival Seni Islami tingkat provinsi.',
                'konten' => [
                    'Tim Hadrah Pondok Pesantren Darul Abror kembali mengukir prestasi gemilang dengan meraih juara 1 dalam Festival Seni Islami tingkat provinsi yang diselenggarakan di Bandung.',
                    'Kompetisi yang diikuti oleh 50 tim dari berbagai pondok pesantren se-Jawa Barat ini menampilkan berbagai kategori seni Islami, termasuk hadrah, nasyid, dan kaligrafi.',
                    'Tim hadrah Darul Abror yang beranggotakan 15 santri putra ini berhasil memukau juri dengan penampilan yang memadukan tradisi dan inovasi modern.',
                    'Prestasi ini menambah koleksi trofi pondok pesantren dalam bidang seni dan budaya Islami.'
                ],
                'tags' => ['Hadrah', 'Festival', 'Seni Islami', 'Juara', 'Prestasi']
            ]
        ];

        return $beritaData[$slug] ?? null;
    }

    private function getBeritaTerkait($currentSlug)
    {
        return [
            [
                'slug' => 'santri-juara-mtq-nasional',
                'judul' => 'Santri Darul Abror Juara MTQ Tingkat Nasional',
                'kategori' => 'Prestasi',
                'kategori_class' => 'bg-success',
                'tanggal' => '4 Juni 2025',
                'gambar' => 'assets/images/public/berita/berita2.jpg'
            ],
            [
                'slug' => 'program-tahfidz-intensif',
                'judul' => 'Program Tahfidz Intensif Selama Ramadhan',
                'kategori' => 'Akademik',
                'kategori_class' => 'bg-info',
                'tanggal' => '3 Juni 2025',
                'gambar' => 'assets/images/public/berita/berita3.jpg'
            ],
            [
                'slug' => 'workshop-entrepreneurship',
                'judul' => 'Workshop Entrepreneurship untuk Santri',
                'kategori' => 'Kegiatan Santri',
                'kategori_class' => 'bg-primary',
                'tanggal' => '1 Juni 2025',
                'gambar' => 'assets/images/public/berita/berita5.jpg'
            ]
        ];
    }
}
