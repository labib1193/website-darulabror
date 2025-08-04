@extends('layouts.app')

@section('title', 'Madrasah Diniyah - Pondok Pesantren Darul Abror')

@section('content')
<div class="madrasah-diniyah">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5 text-white" style="background: linear-gradient(135deg, var(--primary-color) 0%, #004d1f 100%);">
        <div class="container">
            <h1 class="fw-bold mb-3">Madrasah Diniyah</h1>
            <p class="lead mb-0">Pendidikan Agama Islam Komprehensif untuk Generasi Berakhlak Mulia</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="madrasah-content py-5">
        <div class="container">
            <!-- Tentang Madrasah Diniyah -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Tentang Madrasah Diniyah Darul Abror</h2>
                    <p class="lead text-muted">
                        Madrasah Diniyah Darul Abror adalah lembaga pendidikan agama Islam non-formal yang menyelenggarakan pembelajaran ilmu-ilmu keislaman dengan kurikulum yang komprehensif dan terintegrasi. Kami berkomitmen membentuk generasi yang memiliki pemahaman mendalam tentang ajaran Islam dan mampu mengamalkannya dalam kehidupan sehari-hari.
                    </p>
                </div>
            </div>

            <!-- Jenjang Pendidikan -->
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="text-center fw-bold mb-4">Jenjang Pendidikan</h3>
                    <div class="row g-4">
                        <!-- Ula -->
                        <div class="col-md-4">
                            <div class="jenjang-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--primary-color);">
                                    <h5 class="fw-bold mb-0">Madrasah Diniyah Ula</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-2" style="width: 60px; height: 60px; color: var(--primary-color);">
                                            <i class="fas fa-child fa-2x"></i>
                                        </div>
                                        <p class="fw-bold">Kelas 1 - 2 (Usia 7-9 tahun)</p>
                                    </div>
                                    <h6 class="fw-bold mb-2">Mata Pelajaran:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Al-Qur'an & Tajwid</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Aqidah Akhlak</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Fiqh Dasar</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Sejarah Islam</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Bahasa Arab Dasar</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Hadits Pilihan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Wustha -->
                        <div class="col-md-4">
                            <div class="jenjang-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--primary-color);">
                                    <h5 class="fw-bold mb-0">Madrasah Diniyah Wustha</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-2" style="width: 60px; height: 60px; color: var(--primary-color);">
                                            <i class="fas fa-user-graduate fa-2x"></i>
                                        </div>
                                        <p class="fw-bold">Kelas 3 - 4 (Usia 10-12 tahun)</p>
                                    </div>
                                    <h6 class="fw-bold mb-2">Mata Pelajaran:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Qira'ah Al-Qur'an</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Ilmu Tajwid</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Fiqh Ibadah</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Aqidah Islam</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Bahasa Arab Menengah</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--primary-color);"></i>Sirah Nabawiyah</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Ulya -->
                        <div class="col-md-4">
                            <div class="jenjang-card card h-100 border-0 shadow-sm">
                                <div class="card-header text-white text-center" style="background-color: var(--secondary-color);">
                                    <h5 class="fw-bold mb-0">Madrasah Diniyah Ulya</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-light mb-2" style="width: 60px; height: 60px; color: var(--secondary-color);">
                                            <i class="fas fa-university fa-2x"></i>
                                        </div>
                                        <p class="fw-bold">Kelas 5 - 6 (Usia 13-15 tahun)</p>
                                    </div>
                                    <h6 class="fw-bold mb-2">Mata Pelajaran:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-book me-2" style="color: var(--secondary-color);"></i>Tafsir Al-Qur'an</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--secondary-color);"></i>Ulumul Qur'an</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--secondary-color);"></i>Fiqh Muamalah</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--secondary-color);"></i>Ulumul Hadits</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--secondary-color);"></i>Nahwu Shorof</li>
                                        <li><i class="fas fa-book me-2" style="color: var(--secondary-color);"></i>Mantiq & Ushul Fiqh</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Metode Pembelajaran -->
            <div class="row mb-5">
                <div class="col-12">
                    <h3 class="text-center fw-bold mb-4">Metode Pembelajaran</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="metode-card p-4 bg-white rounded shadow-sm border-left border-4" style="border-left-color: var(--primary-color) !important;">
                                <h5 class="fw-bold mb-3"><i class="fas fa-chalkboard-teacher me-2" style="color: var(--primary-color);"></i>Metode Klasikal</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i><strong>Bandongan:</strong> Pembelajaran kitab dengan ustadz membaca dan menjelaskan</li>
                                    <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i><strong>Sorogan:</strong> Santri membaca kitab individual kepada ustadz</li>
                                    <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--primary-color);"></i><strong>Halaqoh:</strong> Diskusi kelompok dalam lingkaran kecil</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="metode-card p-4 bg-white rounded shadow-sm border-left border-4" style="border-left-color: var(--secondary-color) !important;">
                                <h5 class="fw-bold mb-3"><i class="fas fa-laptop me-2" style="color: var(--secondary-color);"></i>Metode Modern</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i><strong>Multimedia:</strong> Pembelajaran dengan audio visual</li>
                                    <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i><strong>Presentasi:</strong> Santri mempresentasikan materi</li>
                                    <li class="mb-2"><i class="fas fa-check me-2" style="color: var(--secondary-color);"></i><strong>Praktek:</strong> Aplikasi langsung dalam kehidupan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Keunggulan & Fasilitas -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="info-card p-4 bg-light rounded">
                        <h4 class="fw-bold mb-3"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i>Keunggulan Program</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-trophy me-2" style="color: var(--secondary-color);"></i>Kurikulum terintegrasi & berstandar</li>
                            <li class="mb-2"><i class="fas fa-trophy me-2" style="color: var(--secondary-color);"></i>Tenaga pengajar berkualifikasi S1/S2</li>
                            <li class="mb-2"><i class="fas fa-trophy me-2" style="color: var(--secondary-color);"></i>Pembelajaran kitab kuning otentik</li>
                            <li class="mb-2"><i class="fas fa-trophy me-2" style="color: var(--secondary-color);"></i>Pembinaan akhlak intensif</li>
                            <li class="mb-2"><i class="fas fa-trophy me-2" style="color: var(--secondary-color);"></i>Evaluasi berkala & sistematis</li>
                            <li class="mb-2"><i class="fas fa-trophy me-2" style="color: var(--secondary-color);"></i>Sertifikat resmi dari Kemenag</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="info-card p-4 bg-light rounded">
                        <h4 class="fw-bold mb-3"><i class="fas fa-building me-2" style="color: var(--primary-color);"></i>Fasilitas Pembelajaran</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-home me-2" style="color: var(--primary-color);"></i>Ruang kelas ber-AC & nyaman</li>
                            <li class="mb-2"><i class="fas fa-home me-2" style="color: var(--primary-color);"></i>Perpustakaan kitab lengkap</li>
                            <li class="mb-2"><i class="fas fa-home me-2" style="color: var(--primary-color);"></i>Lab bahasa Arab</li>
                            <li class="mb-2"><i class="fas fa-home me-2" style="color: var(--primary-color);"></i>Mushalla untuk praktek ibadah</li>
                            <li class="mb-2"><i class="fas fa-home me-2" style="color: var(--primary-color);"></i>Media pembelajaran modern</li>
                            <li class="mb-2"><i class="fas fa-home me-2" style="color: var(--primary-color);"></i>Kantin & area istirahat</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Jadwal Pembelajaran -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="jadwal-section p-4 bg-white rounded shadow-sm">
                        <h4 class="fw-bold mb-3 text-center"><i class="fas fa-calendar me-2" style="color: var(--primary-color);"></i>Jadwal Pembelajaran</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Pagi (Ba'da Subuh)</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td><strong>Senin - Kamis</strong></td>
                                                <td>05:30 - 06:30 WIB</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sabtu</strong></td>
                                                <td>05:30 - 06:30 WIB</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Sore (Ba'da Ashar)</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <td><strong>Senin - Kamis</strong></td>
                                                <td>15:45 - 17:00 WIB</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Sabtu</strong></td>
                                                <td>15:45 - 17:00 WIB</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
        --third-color: #FFFBE6;
        --fourth-color: #D5ED9F;
    }

    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #004d1f 100%);
    }

    .jenjang-card,
    .metode-card,
    .info-card {
        transition: all 0.3s ease;
    }

    .jenjang-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .metode-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .border-left {
        border-left: 4px solid !important;
    }

    .icon-wrapper {
        transition: all 0.3s ease;
    }

    .jenjang-card:hover .icon-wrapper {
        transform: scale(1.1);
    }

    .jadwal-section {
        border: 1px solid #e9ecef;
    }
</style>
@endpush
@endsection