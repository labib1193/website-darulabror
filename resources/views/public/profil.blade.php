@extends('layouts.app')

@section('title', 'Profil - Pondok Pesantren Darul Abror')

@section('content')
<div class="profil">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5 bg-primary text-white">
        <div class="container">
            <h1 class="fw-bold mb-3">Profil Pondok Pesantren</h1>
            <p class="lead mb-0">Mengenal Lebih Dekat Pondok Pesantren Darul Abror</p>
        </div>
    </section>

    <!-- Menu Profil Section -->
    <section class="profil-menu py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4">
                        <!-- Sambutan -->
                        <div class="col-md-6">
                            <div class="profil-card card h-100 border-0 shadow-sm">
                                <div class="card-body p-4 text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-user-tie fa-2x"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Sambutan Pimpinan</h4>
                                    <p class="text-muted mb-4">Pesan dan harapan dari pengasuh Pondok Pesantren Darul Abror untuk seluruh santri dan masyarakat.</p>
                                    <a href="{{ route('profil.sambutan') }}" class="btn btn-primary">Lihat Sambutan <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Sejarah -->
                        <div class="col-md-6">
                            <div class="profil-card card h-100 border-0 shadow-sm">
                                <div class="card-body p-4 text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary text-white mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-history fa-2x"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Sejarah</h4>
                                    <p class="text-muted mb-4">Perjalanan panjang dan perkembangan Pondok Pesantren Darul Abror dari masa ke masa.</p>
                                    <a href="{{ route('profil.sejarah') }}" class="btn btn-secondary">Lihat Sejarah <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Visi Misi -->
                        <div class="col-md-6">
                            <div class="profil-card card h-100 border-0 shadow-sm">
                                <div class="card-body p-4 text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-success text-white mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-bullseye fa-2x"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Visi & Misi</h4>
                                    <p class="text-muted mb-4">Landasan filosofis dan arah tujuan Pondok Pesantren Darul Abror dalam mendidik generasi muslim.</p>
                                    <a href="{{ route('profil.visi-misi') }}" class="btn btn-success">Lihat Visi Misi <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Ekstrakurikuler -->
                        <div class="col-md-6">
                            <div class="profil-card card h-100 border-0 shadow-sm">
                                <div class="card-body p-4 text-center">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle bg-warning text-white mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-running fa-2x"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Ekstrakurikuler</h4>
                                    <p class="text-muted mb-4">Berbagai program pengembangan bakat dan minat santri di luar kegiatan akademik reguler.</p>
                                    <a href="{{ route('profil.ekstrakurikuler') }}" class="btn btn-warning">Lihat Program <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Tentang Pondok Pesantren Darul Abror</h2>
                    <p class="lead text-muted mb-4">
                        Pondok Pesantren Darul Abror adalah lembaga pendidikan Islam yang berkomitmen untuk membentuk generasi muslim yang bertaqwa, berilmu, dan berakhlak mulia. Dengan menggabungkan nilai-nilai tradisional pesantren dan pendekatan modern, kami berupaya menciptakan lingkungan belajar yang kondusif untuk pengembangan potensi santri secara optimal.
                    </p>
                    <div class="row g-4 mt-4">
                        <div class="col-md-3 text-center">
                            <div class="stat-item">
                                <h3 class="fw-bold text-primary">30+</h3>
                                <p class="text-muted">Tahun Berpengalaman</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="stat-item">
                                <h3 class="fw-bold text-primary">500+</h3>
                                <p class="text-muted">Santri Aktif</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="stat-item">
                                <h3 class="fw-bold text-primary">50+</h3>
                                <p class="text-muted">Tenaga Pendidik</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="stat-item">
                                <h3 class="fw-bold text-primary">100+</h3>
                                <p class="text-muted">Alumni Sukses</p>
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
    .profil-card {
        transition: all 0.3s ease;
        border-radius: 15px;
    }

    .profil-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .icon-wrapper {
        transition: all 0.3s ease;
    }

    .profil-card:hover .icon-wrapper {
        transform: scale(1.1);
    }

    .stat-item {
        transition: transform 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection