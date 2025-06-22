@extends('layouts.app')

@section('title', 'Profil - Pondok Pesantren Darul Abror')

@section('content')
<div class="profil">
    <!-- Section Sambutan Pimpinan -->
    <section class="section-pimpinan py-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 text-center mb-4">
                    <div class="image-container">
                        <img src="{{ asset('assets/images/public/profil/abah.jpg') }}" alt="Pimpinan Pondok" class="fotoprofil" style="max-width: 300px;">
                        <div class="nama-pimpinan fw-bold">Abah Taufiqur Rohman</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="text-container px-md-4">
                        <h5 class="text-muted mb-2 text-center">Pengasuh Pondok Pesantren Darul Abror Purwokerto</h5>
                        <h3 class="fw-bold mb-4 text-center">Assalamu'alaikum Wr. Wb.</h3>
                        <p class="mb-4">
                            Pondok Pesantren Darul Abror hadir sebagai lembaga pendidikan yang tidak hanya mengajarkan ilmu agama, tetapi juga membentuk karakter santri agar memiliki keberanian dalam menuntut ilmu. Kami senantiasa mengajak seluruh santri untuk menghilangkan rasa malu yang dapat menghambat proses belajar. Santri harus berani bertanya, aktif berdiskusi, dan tidak segan untuk menyampaikan pendapatnya, karena keberanian ini adalah bekal penting dalam memahami ajaran agama secara mendalam.
                        </p>
                        <p class="text-justify">
                            Di lingkungan pesantren ini, kami menanamkan nilai-nilai kedisiplinan dan tanggung jawab sebagai bagian dari pembinaan karakter. Melalui kegiatan harian, seperti mengikuti kajian, salat berjamaah, dan berbagai aktivitas pesantren, diharapkan santri dapat membiasakan diri untuk hidup teratur dan patuh pada aturan. Semua ini menjadi fondasi dalam membangun generasi yang berilmu, berakhlak mulia, serta siap menjadi teladan di tengah masyarakat.
                        </p>
                        <p>
                            Kami terus berupaya menciptakan suasana belajar yang mendorong santri untuk aktif, kritis, dan percaya diri. Metode pembelajaran di Pondok Pesantren Darul Abror dirancang untuk mendukung tujuan tersebut, melalui sorogan, bandongan, dan diskusi kelompok. Dengan bekal ilmu, akhlak, dan keberanian, kami berharap santri Darul Abror dapat menjadi pribadi yang bermanfaat bagi agama, bangsa, dan negara.
                        </p>
                        <!-- <p class="fw-semibold mt-4 text-end">– H. Arif Hizbullah, MA –</p> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Sambutan Pimpinan -->

    <!-- Section Visi Misi -->
    <section class="visi-misi-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="visi-misi-card p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-bold mb-3">Visi</h4>
                        <p class="text-muted">Mewujudkan generasi muslim yang bertaqwa, berilmu, terampil dan berakhlak mulia</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="visi-misi-card p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-bold mb-3">Misi</h4>
                        <ul class="text-muted">
                            <li>Menyelenggarakan pendidikan yang berkualitas dalam pencapaian prestasi akademik dan non akademik</li>
                            <li>Mewujudkan pembelajaran dan pembiasaan dalam mempelajari Al-Qur'an dan menjalankan ajaran agama Islam</li>
                            <li>Mewujudkan pembentukan karakter Islami yang mampu mengaktualisasikan diri dalam masyarakat</li>
                            <li>Meningkatkan pengetahuan dan profesionalisme tenaga kependidikan sesuai dengan perkembangan dunia pendidikan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Visi Misi -->

    <!-- Section Sejarah -->
    <section class="timeline-section py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Sejarah Pondok Pesantren</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">1990</div>
                        <p>Pendirian awal Pondok Pesantren Darul Abror oleh para ulama dan tokoh masyarakat.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">1995</div>
                        <p>Pembangunan masjid pertama dan perluasan area pondok.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2000</div>
                        <p>Pengembangan program pendidikan dengan penambahan Madrasah Diniyah.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2010</div>
                        <p>Modernisasi fasilitas dan pengembangan program tahfidz.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2020</div>
                        <p>Pengembangan program pendidikan modern dan fasilitas teknologi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Sejarah -->
</div>
@endsection