@extends('layouts.app')

@section('title', 'Visi Misi - Pondok Pesantren Darul Abror')

@section('content')
<div class="visi-misi">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5 text-white">
        <div class="container">
            <h1 class="fw-bold mb-3">Visi & Misi</h1>
            <p class="lead mb-0">Landasan Filosofis Pondok Pesantren Darul Abror</p>
        </div>
    </section>

    <!-- Section Visi Misi -->
    <section class="visi-misi-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Arah dan Tujuan Kami</h2>
                    <p class="lead text-muted">
                        Sebagai lembaga pendidikan Islam, kami memiliki komitmen yang jelas dalam membentuk generasi muslim yang unggul dan berkarakter.
                    </p>
                </div>
            </div>

            <div class="row">
                <!-- Visi -->
                <div class="col-lg-6 mb-5">
                    <div class="visi-card p-5 bg-white rounded-lg shadow-lg h-100" style="border-top: 4px solid var(--primary-color);">
                        <div class="text-center mb-4">
                            <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white mb-3" style="width: 80px; height: 80px; background-color: var(--primary-color);">
                                <i class="fas fa-eye fa-2x"></i>
                            </div>
                            <h3 class="fw-bold" style="color: var(--primary-color);">VISI</h3>
                        </div>
                        <div class="visi-content">
                            <blockquote class="blockquote text-center">
                                <p class="mb-4 lead font-italic">"Mewujudkan generasi muslim yang bertaqwa, berilmu, terampil dan berakhlak mulia"</p>
                            </blockquote>
                            <div class="visi-explanation">
                                <h5 class="fw-bold mb-3">Penjelasan Visi:</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i><strong>Bertaqwa:</strong> Memiliki ketakwaan yang kuat kepada Allah SWT</li>
                                    <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i><strong>Berilmu:</strong> Menguasai ilmu agama dan pengetahuan umum</li>
                                    <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i><strong>Terampil:</strong> Memiliki keterampilan praktis untuk kehidupan</li>
                                    <li class="mb-2"><i class="fas fa-star me-2" style="color: var(--secondary-color);"></i><strong>Berakhlak Mulia:</strong> Memiliki karakter dan moral yang terpuji</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Misi -->
                <div class="col-lg-6 mb-5">
                    <div class="misi-card p-5 bg-white rounded-lg shadow-lg h-100" style="border-top: 4px solid var(--secondary-color);">
                        <div class="text-center mb-4">
                            <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white mb-3" style="width: 80px; height: 80px; background-color: var(--secondary-color);">
                                <i class="fas fa-bullseye fa-2x"></i>
                            </div>
                            <h3 class="fw-bold" style="color: var(--secondary-color);">MISI</h3>
                        </div>
                        <div class="misi-content">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-start">
                                        <span class="badge rounded-pill me-3 mt-1" style="background-color: var(--primary-color);">1</span>
                                        <span>Menyelenggarakan pendidikan yang berkualitas dalam pencapaian prestasi akademik dan non akademik</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-start">
                                        <span class="badge rounded-pill me-3 mt-1" style="background-color: var(--primary-color);">2</span>
                                        <span>Mewujudkan pembelajaran dan pembiasaan dalam mempelajari Al-Qur'an dan menjalankan ajaran agama Islam</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-start">
                                        <span class="badge rounded-pill me-3 mt-1" style="background-color: var(--primary-color);">3</span>
                                        <span>Mewujudkan pembentukan karakter Islami yang mampu mengaktualisasikan diri dalam masyarakat</span>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 px-0 py-3">
                                    <div class="d-flex align-items-start">
                                        <span class="badge rounded-pill me-3 mt-1" style="background-color: var(--primary-color);">4</span>
                                        <span>Meningkatkan pengetahuan dan profesionalisme tenaga kependidikan sesuai dengan perkembangan dunia pendidikan</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nilai-nilai Pondok -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="nilai-section p-5 bg-light rounded-lg">
                        <h3 class="text-center fw-bold mb-4" style="color: var(--primary-color);">Nilai-Nilai Pondok Pesantren Darul Abror</h3>
                        <div class="row">
                            <div class="col-md-3 text-center mb-4">
                                <div class="nilai-item">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white mb-3" style="width: 60px; height: 60px; background-color: var(--primary-color);">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <h5 class="fw-bold">Ikhlas</h5>
                                    <p class="text-muted">Melakukan segala sesuatu dengan niat yang tulus karena Allah SWT</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-4">
                                <div class="nilai-item">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white mb-3" style="width: 60px; height: 60px; background-color: var(--secondary-color);">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <h5 class="fw-bold">Ilmu</h5>
                                    <p class="text-muted">Menuntut ilmu sebagai kewajiban dan bekal kehidupan</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-4">
                                <div class="nilai-item">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white mb-3" style="width: 60px; height: 60px; background-color: var(--primary-color);">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                    <h5 class="fw-bold">Amal</h5>
                                    <p class="text-muted">Mengamalkan ilmu untuk kemaslahatan umat</p>
                                </div>
                            </div>
                            <div class="col-md-3 text-center mb-4">
                                <div class="nilai-item">
                                    <div class="icon-wrapper d-inline-flex align-items-center justify-content-center rounded-circle text-white mb-3" style="width: 60px; height: 60px; background-color: var(--secondary-color);">
                                        <i class="fas fa-balance-scale"></i>
                                    </div>
                                    <h5 class="fw-bold">Adil</h5>
                                    <p class="text-muted">Berlaku adil dalam segala aspek kehidupan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Visi Misi -->
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

    .rounded-lg {
        border-radius: 15px !important;
    }

    .shadow-lg {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }

    .visi-card,
    .misi-card {
        transition: transform 0.3s ease;
    }

    .visi-card:hover,
    .misi-card:hover {
        transform: translateY(-5px);
    }

    .nilai-item {
        transition: transform 0.3s ease;
    }

    .nilai-item:hover {
        transform: translateY(-5px);
    }

    .list-group-item {
        transition: background-color 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush
@endsection