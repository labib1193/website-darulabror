@extends('layouts.app')

@section('title', 'Sejarah - Pondok Pesantren Darul Abror')

@section('content')
<div class="sejarah">
    <!-- Hero Section -->
    <section class="hero-section text-center py-5 bg-primary text-white">
        <div class="container">
            <h1 class="fw-bold mb-3">Sejarah Pondok Pesantren</h1>
            <p class="lead mb-0">Perjalanan Panjang Membangun Generasi Berakhlak Mulia</p>
        </div>
    </section>

    <!-- Section Sejarah -->
    <section class="timeline-section py-5">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h2 class="fw-bold mb-4">Jejak Perjalanan Darul Abror</h2>
                    <p class="lead text-muted">
                        Pondok Pesantren Darul Abror didirikan dengan semangat untuk menciptakan generasi muslim yang tidak hanya berilmu, tetapi juga berakhlak mulia dan mampu berkontribusi positif bagi masyarakat.
                    </p>
                </div>
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">1990</div>
                        <h4 class="fw-bold mb-3">Pendirian Awal</h4>
                        <p>Pendirian awal Pondok Pesantren Darul Abror oleh para ulama dan tokoh masyarakat. Dimulai dengan visi mulia untuk mendidik generasi yang bertaqwa dan berilmu.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">1995</div>
                        <h4 class="fw-bold mb-3">Pembangunan Masjid</h4>
                        <p>Pembangunan masjid pertama dan perluasan area pondok. Masjid menjadi pusat kegiatan ibadah dan pembelajaran yang menunjang aktivitas santri.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2000</div>
                        <h4 class="fw-bold mb-3">Pengembangan Pendidikan</h4>
                        <p>Pengembangan program pendidikan dengan penambahan Madrasah Diniyah. Kurikulum diperkaya dengan berbagai mata pelajaran agama dan umum.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2010</div>
                        <h4 class="fw-bold mb-3">Modernisasi Fasilitas</h4>
                        <p>Modernisasi fasilitas dan pengembangan program tahfidz. Pondok mulai mengadopsi teknologi modern untuk mendukung proses pembelajaran.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2020</div>
                        <h4 class="fw-bold mb-3">Era Digital</h4>
                        <p>Pengembangan program pendidikan modern dan fasilitas teknologi. Adaptasi dengan era digital sambil tetap mempertahankan nilai-nilai tradisional pesantren.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-year">2024</div>
                        <h4 class="fw-bold mb-3">Masa Kini</h4>
                        <p>Terus berinovasi dalam metode pembelajaran dan pengembangan karakter santri. Mempersiapkan generasi yang siap menghadapi tantangan masa depan dengan tetap berpegang teguh pada nilai-nilai Islam.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section Sejarah -->
</div>

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, #004d1f 100%);
    }

    .timeline {
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .timeline::after {
        content: '';
        position: absolute;
        width: 6px;
        background-color: var(--primary-color);
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -3px;
    }

    .timeline-item {
        padding: 10px 40px;
        position: relative;
        background-color: inherit;
        width: 50%;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        right: -17px;
        background-color: var(--secondary-color);
        border: 4px solid #fff;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .timeline-item:nth-child(odd) {
        left: 0;
    }

    .timeline-item:nth-child(even) {
        left: 50%;
    }

    .timeline-item:nth-child(even)::after {
        left: -16px;
    }

    .timeline-content {
        padding: 20px 30px;
        background-color: white;
        position: relative;
        border-radius: 6px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--primary-color);
    }

    .timeline-year {
        background-color: var(--primary-color);
        color: white;
        padding: 5px 15px;
        border-radius: 15px;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 10px;
        font-size: 14px;
    }

    @media screen and (max-width: 600px) {
        .timeline::after {
            left: 31px;
        }

        .timeline-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        .timeline-item::before {
            left: 60px;
            border: medium solid white;
            border-width: 10px 10px 10px 0;
            border-color: transparent white transparent transparent;
        }

        .timeline-item:nth-child(even) {
            left: 0%;
        }

        .timeline-item::after {
            left: 15px;
        }

        .timeline-item:nth-child(even)::after {
            left: 15px;
        }
    }
</style>
@endpush
@endsection