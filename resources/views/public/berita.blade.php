@extends('layouts.app')

@section('title', 'Berita - Pondok Pesantren Darul Abror')

@section('content')
<div class="berita">
    <!-- Hero Section -->
    <section class="berita hero-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="fw-bold mb-4">Berita & Informasi</h1>
                    <div class="search-box bg-white p-3 rounded shadow-sm">
                        <form action="#" method="GET" class="d-flex gap-2">
                            <input type="text" class="form-control" placeholder="Cari berita...">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Navigation -->
    <section class="category-nav py-4 bg-light border-bottom">
        <div class="container">
            <div class="d-flex justify-content-center flex-wrap gap-2">
                <a href="#" class="btn btn-outline-primary active">Semua</a>
                <a href="#" class="btn btn-outline-primary">Akademik</a>
                <a href="#" class="btn btn-outline-primary">Kegiatan Santri</a>
                <a href="#" class="btn btn-outline-primary">Prestasi</a>
                <a href="#" class="btn btn-outline-primary">Pengumuman</a>
            </div>
        </div>
    </section>

    <!-- Featured News -->
    <section class="featured-news py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('images/berita1.jpg') }}" class="card-img-top" alt="Featured News">
                        <div class="card-body p-4">
                            <span class="badge bg-primary mb-2">Kegiatan Santri</span>
                            <h3 class="card-title fw-bold">Perayaan Maulid Nabi Muhammad SAW di Pondok Pesantren</h3>
                            <p class="text-muted mb-2">5 Juni 2025 • 5 menit baca</p>
                            <p class="card-text">Pondok Pesantren Darul Abror mengadakan perayaan Maulid Nabi Muhammad SAW dengan berbagai rangkaian kegiatan yang melibatkan seluruh santri dan pengajar. Acara ini bertujuan untuk mengenang dan mengambil hikmah dari kehidupan Rasulullah SAW...</p>
                            <a href="#" class="btn btn-link text-primary p-0">Baca selengkapnya →</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card border-0 shadow-sm">
                                <img src="{{ asset('images/berita2.jpg') }}" class="card-img-top" alt="News">
                                <div class="card-body">
                                    <span class="badge bg-success mb-2">Prestasi</span>
                                    <h5 class="card-title fw-bold">Santri Darul Abror Juara MTQ Tingkat Nasional</h5>
                                    <p class="text-muted mb-2">4 Juni 2025 • 3 menit baca</p>
                                    <a href="#" class="btn btn-link text-primary p-0">Baca selengkapnya →</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <img src="{{ asset('images/berita3.jpg') }}" class="card-img-top" alt="News">
                                <div class="card-body">
                                    <span class="badge bg-info mb-2">Akademik</span>
                                    <h5 class="card-title fw-bold">Program Tahfidz Intensif Selama Ramadhan</h5>
                                    <p class="text-muted mb-2">3 Juni 2025 • 4 menit baca</p>
                                    <a href="#" class="btn btn-link text-primary p-0">Baca selengkapnya →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Grid -->
    <section class="latest-news py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">Berita Terbaru</h2>
            <div class="row g-4">
                <!-- Berita Item -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/berita1.jpg') }}" class="card-img-top" alt="News">
                        <div class="card-body">
                            <span class="badge bg-warning mb-2">Pengumuman</span>
                            <h5 class="card-title fw-bold">Pembukaan Pendaftaran Santri Baru Tahun Ajaran 2025/2026</h5>
                            <p class="text-muted mb-2">2 Juni 2025 • 3 menit baca</p>
                            <p class="card-text">Pondok Pesantren Darul Abror membuka pendaftaran santri baru untuk tahun ajaran 2025/2026. Pendaftaran dapat dilakukan secara online melalui website resmi...</p>
                            <a href="#" class="btn btn-link text-primary p-0">Baca selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <!-- Berita Item -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/berita2.jpg') }}" class="card-img-top" alt="News">
                        <div class="card-body">
                            <span class="badge bg-primary mb-2">Kegiatan Santri</span>
                            <h5 class="card-title fw-bold">Workshop Entrepreneurship untuk Santri</h5>
                            <p class="text-muted mb-2">1 Juni 2025 • 4 menit baca</p>
                            <p class="card-text">Dalam rangka mempersiapkan santri menghadapi era digital, Pondok Pesantren mengadakan workshop kewirausahaan yang fokus pada e-commerce...</p>
                            <a href="#" class="btn btn-link text-primary p-0">Baca selengkapnya →</a>
                        </div>
                    </div>
                </div>

                <!-- Berita Item -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/berita3.jpg') }}" class="card-img-top" alt="News">
                        <div class="card-body">
                            <span class="badge bg-success mb-2">Prestasi</span>
                            <h5 class="card-title fw-bold">Tim Hadrah Raih Juara di Festival Seni Islami</h5>
                            <p class="text-muted mb-2">31 Mei 2025 • 3 menit baca</p>
                            <p class="card-text">Tim Hadrah Pondok Pesantren Darul Abror berhasil meraih juara 1 dalam Festival Seni Islami tingkat provinsi yang diselenggarakan...</p>
                            <a href="#" class="btn btn-link text-primary p-0">Baca selengkapnya →</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</div>
@endsection