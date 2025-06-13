@extends('layouts.app')

@section('title', 'Ekstrakurikuler- Pondok Pesantren Darul Abror')

@section('content')
<div class="ekstrakurikuler">
    <!-- Hero Section -->
    <section class="ekstrakurikuler hero-section text-center py-5 bg-primary text-white">
        <div class="container">
            <h1 class="fw-bold mb-3">Program Ekstrakurikuler</h1>
            <p class="lead mb-0">Mengembangkan Bakat dan Potensi Santri Melalui Kegiatan yang Bermakna</p>
        </div>
    </section>

    <!-- Main Ekstrakurikuler Section -->
    <section class="ekstrakurikuler py-5">
        <div class="container">
            <!-- Kategori Keagamaan -->
            <div class="category-section mb-5">
                <h3 class="section-title text-center mb-4">Program Keagamaan</h3>
                <div class="row g-4">
                    <!-- Tahfidz -->
                    <div class="col-md-6">
                        <div class="ekskul-card card h-100 border-0 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/tahfid.jpg') }}" class="img-fluid rounded-start h-100" alt="Tahfidz" style="object-fit: cover;">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold mb-3">Program Tahfidz</h4>
                                        <p class="card-text">Program unggulan untuk menghafal Al-Qur'an dengan bimbingan ustadz dan ustadzah yang berpengalaman. Dilengkapi dengan metode modern dan jadwal terstruktur.</p>
                                        <ul class="list-unstyled mb-0">
                                            <li><i class="fas fa-clock text-primary me-2"></i> Setiap hari ba'da Subuh & Ashar</li>
                                            <li><i class="fas fa-user-friends text-primary me-2"></i> Dibimbing oleh Hafidz/ah</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hadroh -->
                    <div class="col-md-6">
                        <div class="ekskul-card card h-100 border-0 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/hadroh.jpg') }}" class="img-fluid rounded-start h-100" alt="Hadroh" style="object-fit: cover;">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold mb-3">Seni Hadroh</h4>
                                        <p class="card-text">Mengembangkan bakat seni musik Islami melalui permainan rebana dan vocal sholawat. Tim hadroh kami telah meraih berbagai prestasi di tingkat provinsi.</p>
                                        <ul class="list-unstyled mb-0">
                                            <li><i class="fas fa-calendar text-primary me-2"></i> Setiap Jum'at & Minggu</li>
                                            <li><i class="fas fa-trophy text-primary me-2"></i> Juara 1 Festival Hadroh 2024</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kategori Olahraga -->
            <div class="category-section mb-5">
                <h3 class="section-title text-center mb-4">Program Olahraga</h3>
                <div class="row g-4">
                    <!-- Pencak Silat -->
                    <div class="col-md-6">
                        <div class="ekskul-card card h-100 border-0 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/silat.jpg') }}" class="img-fluid rounded-start h-100" alt="Pencak Silat" style="object-fit: cover;">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold mb-3">Pencak Silat</h4>
                                        <p class="card-text">Belajar seni bela diri tradisional yang menggabungkan aspek mental, fisik, dan spiritual. Diajarkan oleh pelatih profesional bersertifikat.</p>
                                        <ul class="list-unstyled mb-0">
                                            <li><i class="fas fa-calendar text-primary me-2"></i> Setiap Sabtu & Minggu</li>
                                            <li><i class="fas fa-medal text-primary me-2"></i> Prestasi Tingkat Nasional</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Futsal -->
                    <div class="col-md-6">
                        <div class="ekskul-card card h-100 border-0 shadow-sm">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <img src="{{ asset('images/futsal.jpg') }}" class="img-fluid rounded-start h-100" alt="Futsal" style="object-fit: cover;">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold mb-3">Futsal</h4>
                                        <p class="card-text">Mengembangkan kemampuan olahraga futsal dengan pelatihan rutin dan kompetisi. Dilengkapi dengan fasilitas lapangan standar.</p>
                                        <ul class="list-unstyled mb-0">
                                            <li><i class="fas fa-calendar text-primary me-2"></i> Setiap Kamis & Minggu</li>
                                            <li><i class="fas fa-futbol text-primary me-2"></i> Liga Santri Regional</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="cta-section text-center py-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h3 class="fw-bold mb-4">Tertarik dengan Program Ekstrakurikuler Kami?</h3>
                        <p class="mb-4">Daftarkan diri Anda sekarang dan kembangkan potensi bersama kami!</p>
                        <a href="{{ route('pendaftaran') }}" class="btn btn-primary btn-lg">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="achievements py-5 bg-light">
        <div class="container">
            <h3 class="text-center fw-bold mb-5">Prestasi Ekstrakurikuler</h3>
            <div class="row g-4 justify-content-center">
                <div class="col-md-3 text-center">
                    <div class="achievement-item">
                        <i class="fas fa-trophy fa-3x text-primary mb-3"></i>
                        <h4 class="fw-bold">50+</h4>
                        <p class="text-muted">Penghargaan Diraih</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="achievement-item">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h4 class="fw-bold">300+</h4>
                        <p class="text-muted">Santri Aktif</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="achievement-item">
                        <i class="fas fa-medal fa-3x text-primary mb-3"></i>
                        <h4 class="fw-bold">25+</h4>
                        <p class="text-muted">Kompetisi Diikuti</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="achievement-item">
                        <i class="fas fa-star fa-3x text-primary mb-3"></i>
                        <h4 class="fw-bold">15+</h4>
                        <p class="text-muted">Pelatih Profesional</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection