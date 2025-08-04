@extends('layouts.app')

@section('title', 'BQ-PI - Pondok Pesantren Darul Abror')

@section('content')
<div class="bq-pi">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5 text-white" style="background: linear-gradient(135deg, var(--primary-color) 0%, #004d1f 100%);">
        <div class="container">
            <h1 class="fw-bold mb-3">BQ-PI (Baca Quran - Pendidikan Islam)</h1>
            <p class="lead mb-0">Program Intensif Al-Qur'an dan Pendidikan Islam Terpadu</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="bq-pi-content py-5">
        <div class="container">
            <!-- Tentang BQ-PI -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Tentang Program BQ-PI</h2>
                    <p class="lead text-muted">
                        BQ-PI (Baca Quran - Pendidikan Islam) adalah program unggulan Pondok Pesantren Darul Abror yang menggabungkan pembelajaran Al-Qur'an dengan pendidikan Islam komprehensif. Program ini dirancang khusus untuk remaja dan dewasa yang ingin memperdalam pemahaman Al-Qur'an dan ajaran Islam secara intensif.
                    </p>
                </div>
            </div>

            <!-- Program Utama -->
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="text-center fw-bold mb-4">Program Pembelajaran</h3>
                    <div class="row g-4">
                        <!-- Baca Quran -->
                        <div class="col-md-6">
                            <div class="program-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--primary-color);">
                                    <h5 class="fw-bold mb-0"><i class="fas fa-quran-book me-2"></i>BACA QURAN</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-2" style="width: 60px; height: 60px; color: var(--primary-color);">
                                            <i class="fas fa-book-open fa-2x"></i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-3">Materi Pembelajaran:</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Tahsin (Perbaikan Bacaan)</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Tajwid Lanjutan</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Qira'ah Sab'ah</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Tahfidz Al-Qur'an</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Tilawah dengan Lagu</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Adab Membaca Al-Qur'an</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Pendidikan Islam -->
                        <div class="col-md-6">
                            <div class="program-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--secondary-color);">
                                    <h5 class="fw-bold mb-0"><i class="fas fa-mosque me-2"></i>PENDIDIKAN ISLAM</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-2" style="width: 60px; height: 60px; color: var(--secondary-color);">
                                            <i class="fas fa-graduation-cap fa-2x"></i>
                                        </div>
                                    </div>
                                    <h6 class="fw-bold mb-3">Materi Pembelajaran:</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i>Tafsir Al-Qur'an</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i>Hadits & Ulumul Hadits</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i>Fiqh Kontemporer</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i>Aqidah & Tasawuf</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i>Sirah & Tarikh Islam</li>
                                        <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i>Dakwah & Komunikasi</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Level Program -->
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="text-center fw-bold mb-4">Level Program BQ-PI</h3>
                    <div class="row g-4">
                        <!-- Level 1 -->
                        <div class="col-md-4">
                            <div class="level-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--primary-color);">
                                    <h5 class="fw-bold mb-0">Level 1 - Dasar</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 60px; height: 60px; color: var(--primary-color);">
                                        <i class="fas fa-seedling fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold">Durasi: 6 Bulan</h6>
                                    <p class="text-muted mb-3">Untuk pemula atau yang ingin memperbaiki bacaan Al-Qur'an</p>
                                    <ul class="list-unstyled text-start">
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Makharijul Huruf</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Tajwid Dasar</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Fiqh Ibadah</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Aqidah Dasar</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Level 2 -->
                        <div class="col-md-4">
                            <div class="level-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--secondary-color);">
                                    <h5 class="fw-bold mb-0">Level 2 - Menengah</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 60px; height: 60px; color: var(--secondary-color);">
                                        <i class="fas fa-tree fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold">Durasi: 12 Bulan</h6>
                                    <p class="text-muted mb-3">Pengembangan kemampuan dan pemahaman yang lebih mendalam</p>
                                    <ul class="list-unstyled text-start">
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--secondary-color);"></i>Tahsin Intensif</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--secondary-color);"></i>Tafsir Juz 30</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--secondary-color);"></i>Hadits Arbain</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--secondary-color);"></i>Sirah Nabawiyah</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Level 3 -->
                        <div class="col-md-4">
                            <div class="level-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                                    <h5 class="fw-bold mb-0">Level 3 - Lanjut</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 60px; height: 60px; color: var(--primary-color);">
                                        <i class="fas fa-award fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold">Durasi: 18 Bulan</h6>
                                    <p class="text-muted mb-3">Spesialisasi dan persiapan menjadi pengajar/dai</p>
                                    <ul class="list-unstyled text-start">
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Qira'ah Sab'ah</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Tafsir Tematik</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Metodologi Dakwah</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Praktik Mengajar</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keunggulan & Metode -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="info-card p-4 bg-light rounded">
                        <h4 class="fw-bold mb-3"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Keunggulan Program</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-medal me-2" style="color: var(--secondary-color);"></i>Kurikulum terintegrasi & sistematis</li>
                            <li class="mb-2"><i class="fas fa-medal me-2" style="color: var(--secondary-color);"></i>Pembimbing hafidz & ahli tafsir</li>
                            <li class="mb-2"><i class="fas fa-medal me-2" style="color: var(--secondary-color);"></i>Metode pembelajaran modern</li>
                            <li class="mb-2"><i class="fas fa-medal me-2" style="color: var(--secondary-color);"></i>Praktek langsung & aplikatif</li>
                            <li class="mb-2"><i class="fas fa-medal me-2" style="color: var(--secondary-color);"></i>Sertifikat kompetensi</li>
                            <li class="mb-2"><i class="fas fa-medal me-2" style="color: var(--secondary-color);"></i>Bimbingan karir dakwah</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="info-card p-4 bg-light rounded">
                        <h4 class="fw-bold mb-3"><i class="fas fa-cogs me-2" style="color: var(--primary-color);"></i>Metode Pembelajaran</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-users me-2" style="color: var(--primary-color);"></i>Pembelajaran kelompok kecil (max 15 orang)</li>
                            <li class="mb-2"><i class="fas fa-user me-2" style="color: var(--primary-color);"></i>Bimbingan individual intensif</li>
                            <li class="mb-2"><i class="fas fa-microphone me-2" style="color: var(--primary-color);"></i>Praktek tilawah & ceramah</li>
                            <li class="mb-2"><i class="fas fa-laptop me-2" style="color: var(--primary-color);"></i>Media pembelajaran digital</li>
                            <li class="mb-2"><i class="fas fa-clipboard-check me-2" style="color: var(--primary-color);"></i>Evaluasi berkala</li>
                            <li class="mb-2"><i class="fas fa-certificate me-2" style="color: var(--primary-color);"></i>Ujian kompetensi</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Jadwal & Biaya -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="jadwal-card p-4 bg-white rounded shadow-sm border">
                        <h4 class="fw-bold mb-3 text-center"><i class="fas fa-calendar me-2" style="color: var(--primary-color);"></i>Jadwal Pembelajaran</h4>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead style="background-color: var(--primary-color); color: white;">
                                    <tr>
                                        <th>Hari</th>
                                        <th>Waktu</th>
                                        <th>Materi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Senin</td>
                                        <td>19:30-21:00</td>
                                        <td>Baca Quran</td>
                                    </tr>
                                    <tr>
                                        <td>Rabu</td>
                                        <td>19:30-21:00</td>
                                        <td>Pendidikan Islam</td>
                                    </tr>
                                    <tr>
                                        <td>Sabtu</td>
                                        <td>08:00-10:00</td>
                                        <td>Praktek & Evaluasi</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="biaya-card p-4 bg-white rounded shadow-sm border">
                        <h4 class="fw-bold mb-3 text-center"><i class="fas fa-money-bill me-2" style="color: var(--secondary-color);"></i>Investasi Program</h4>
                        <div class="price-list">
                            <div class="price-item d-flex justify-content-between align-items-center p-3 mb-2 bg-light rounded">
                                <span><strong>Level 1 (6 bulan)</strong></span>
                                <span class="fw-bold" style="color: var(--primary-color);">Rp 350.000</span>
                            </div>
                            <div class="price-item d-flex justify-content-between align-items-center p-3 mb-2 bg-light rounded">
                                <span><strong>Level 2 (12 bulan)</strong></span>
                                <span class="fw-bold" style="color: var(--secondary-color);">Rp 600.000</span>
                            </div>
                            <div class="price-item d-flex justify-content-between align-items-center p-3 mb-3 bg-light rounded">
                                <span><strong>Level 3 (18 bulan)</strong></span>
                                <span class="fw-bold" style="color: var(--primary-color);">Rp 850.000</span>
                            </div>
                            <small class="text-muted">*Sudah termasuk modul, sertifikat, dan bimbingan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
    :root {
        --primary-color: #00712D;
        --secondary-color: #FF9100;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #004d1f 100%);
    }

    .program-card,
    .level-card,
    .info-card {
        transition: all 0.3s ease;
    }

    .program-card:hover,
    .level-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .icon-wrapper {
        transition: all 0.3s ease;
    }

    .program-card:hover .icon-wrapper,
    .level-card:hover .icon-wrapper {
        transform: scale(1.1);
    }

    .price-item {
        transition: all 0.3s ease;
    }

    .price-item:hover {
        background-color: #f8f9fa !important;
        transform: translateX(5px);
    }

    .jadwal-card,
    .biaya-card {
        border: 1px solid #e9ecef;
    }
</style>
@endpush
@endsection