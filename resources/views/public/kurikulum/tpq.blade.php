@extends('layouts.app')

@section('title', 'TPQ - Pondok Pesantren Darul Abror')

@section('content')
<div class="tpq">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5 text-white" style="background: linear-gradient(135deg, var(--primary-color) 0%, #004d1f 100%);">
        <div class="container">
            <h1 class="fw-bold mb-3">Taman Pendidikan Al-Qur'an (TPQ)</h1>
            <p class="lead mb-0">Membangun Fondasi Kecintaan terhadap Al-Qur'an sejak Dini</p>
        </div>
    </section>

    <!-- Main TPQ Section -->
    <section class="tpq-content py-5">
        <div class="container">
            <!-- Tentang TPQ -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Tentang TPQ Darul Abror</h2>
                    <p class="lead text-muted">
                        Taman Pendidikan Al-Qur'an (TPQ) Darul Abror adalah program pendidikan dasar untuk anak-anak usia dini dalam mempelajari Al-Qur'an. Dengan metode yang menyenangkan dan mudah dipahami, kami membantu anak-anak membangun fondasi yang kuat dalam membaca, menulis, dan memahami Al-Qur'an.
                    </p>
                </div>
            </div>

            <!-- Program & Metode -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="program-card p-4 bg-white rounded shadow-sm border-left border-4" style="border-left-color: var(--primary-color) !important;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white me-3" style="width: 50px; height: 50px; background-color: var(--primary-color);">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h4 class="fw-bold mb-0">Program Pembelajaran</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Pengenalan Huruf Hijaiyah</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Belajar Membaca Al-Qur'an</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Menulis Huruf Arab</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Hafalan Surat-surat Pendek</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Doa-doa Harian</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Akhlak dan Adab Islam</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="program-card p-4 bg-white rounded shadow-sm border-left border-4" style="border-left-color: var(--secondary-color) !important;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white me-3" style="width: 50px; height: 50px; background-color: var(--secondary-color);">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h4 class="fw-bold mb-0">Metode Pembelajaran</h4>
                        </div>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Metode Iqro' & Qiroati</li>
                            <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Pembelajaran Bermain & Menyenangkan</li>
                            <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Pendekatan Individual</li>
                            <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Media Audio Visual</li>
                            <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Evaluasi Berkala</li>
                            <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Laporan Perkembangan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Jenjang TPQ -->
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="text-center fw-bold mb-4">Jenjang Pembelajaran TPQ</h3>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="jenjang-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--primary-color);">
                                    <h5 class="fw-bold mb-0">Level Pemula</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 60px; height: 60px; color: var(--primary-color);">
                                        <i class="fas fa-seedling fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold">Usia 4-5 Tahun</h6>
                                    <ul class="list-unstyled text-start">
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Pengenalan huruf hijaiyah</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Belajar angka Arab</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Doa sehari-hari sederhana</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="jenjang-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--primary-color);">
                                    <h5 class="fw-bold mb-0">Level Menengah</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 60px; height: 60px; color: var(--primary-color);">
                                        <i class="fas fa-tree fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold">Usia 6-8 Tahun</h6>
                                    <ul class="list-unstyled text-start">
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Iqro' jilid 1-3</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Menulis huruf Arab</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--primary-color);"></i>Hafalan surat Al-Fatihah</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="jenjang-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--secondary-color);">
                                    <h5 class="fw-bold mb-0">Level Lanjut</h5>
                                </div>
                                <div class="card-body text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-3" style="width: 60px; height: 60px; color: var(--secondary-color);">
                                        <i class="fas fa-award fa-2x"></i>
                                    </div>
                                    <h6 class="fw-bold">Usia 9-12 Tahun</h6>
                                    <ul class="list-unstyled text-start">
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--secondary-color);"></i>Iqro' jilid 4-6</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--secondary-color);"></i>Membaca Al-Qur'an</li>
                                        <li><i class="fas fa-dot-circle me-2" style="color: var(--secondary-color);"></i>Hafalan Juz 30</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal & Informasi -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="info-card p-4 bg-light rounded">
                        <h4 class="fw-bold mb-3"><i class="fas fa-clock me-2" style="color: var(--primary-color);"></i>Jadwal Pembelajaran</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><strong>Senin - Kamis</strong></td>
                                        <td>15:30 - 17:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sabtu</strong></td>
                                        <td>08:00 - 10:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Minggu</strong></td>
                                        <td>08:00 - 10:00 WIB</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="info-card p-4 bg-light rounded">
                        <h4 class="fw-bold mb-3"><i class="fas fa-user-friends me-2" style="color: var(--primary-color);"></i>Fasilitas & Tenaga Pengajar</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Ustadz/ah berpengalaman</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Ruang belajar ber-AC</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Media pembelajaran modern</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Buku panduan lengkap</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Evaluasi rutin</li>
                            <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i>Bimbingan individual</li>
                        </ul>
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
        --third-color: #FFFBE6;
        --fourth-color: #D5ED9F;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #004d1f 100%);
    }

    .program-card,
    .jenjang-card,
    .info-card {
        transition: all 0.3s ease;
    }

    .program-card:hover,
    .jenjang-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .border-left {
        border-left: 4px solid !important;
    }

    .icon-wrapper {
        transition: all 0.3s ease;
    }

    .program-card:hover .icon-wrapper {
        transform: scale(1.1);
    }

    .jenjang-card:hover .icon-wrapper {
        transform: scale(1.1);
    }
</style>
@endpush
@endsection