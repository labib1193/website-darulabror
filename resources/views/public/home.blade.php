@extends('layouts.app')

@section('title', 'Beranda - Pondok Pesantren Darul Abror')

@section('content')
<div class="home">

    <!-- Carousel -->
    <section id="carouselExampleIndicators" class="carousel slider" data-bs-ride="carousel" data-bs-interval="100">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ secure_asset('assets/images/public/home/banner1.png') }}" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ secure_asset('assets/images/public/home/banner2.png') }}" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ secure_asset('assets/images/public/home/banner3.png') }}" alt="Slide 3">
            </div>
        </div>
        <!-- <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-custom-icon"><i class="fas fa-chevron-left"></i></span>
            <span class="sr-only">Previous</span>
        </a> -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-custom-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-custom-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <!-- <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-custom-icon"><i class="fas fa-chevron-right"></i></span>
            <span class="sr-only">Next</span>
        </a> -->
    </section>
    <!-- /.carousel -->

    <!-- Section Pendidikan -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Program Pendidikan</h2>
            <div class="row justify-content-center">

                <!-- MADIN -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="mb-4">
                            <img src="{{ asset('assets/images/public/home/icon1.png') }}" alt="Komputer" class="img-fluid" style="width: 80px;">
                        </div>
                        <h4 class="card-title mb-3">Madrasah Diniyah (MADIN)</h4>
                        <p class="card-text text-muted">Program studi unggulan di bidang teknologi informasi dan komputasi</p>
                    </div>
                </div>

                <!-- BTA PI -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="mb-4">
                            <img src="{{ asset('assets/images/public/home/icon2.png') }}" alt="Bisnis" class="img-fluid" style="width: 80px;">
                        </div>
                        <h4 class="card-title mb-3">BQ-PI (Baca Qur'an - Praktik Ibadah)</h4>
                        <p class="card-text text-muted">Program studi yang fokus pada pengembangan bisnis dan ilmu sosial</p>
                    </div>
                </div>

                <!-- TPQ -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="mb-4">
                            <img src="{{ asset('assets/images/public/home/icon3.png') }}" alt="Kesehatan" class="img-fluid" style="width: 80px;">
                        </div>
                        <h4 class="card-title mb-3">Taman Pendidikan Al-Qur'an (TPQ)</h4>
                        <p class="card-text text-muted">Program studi dalam bidang kesehatan dan pelayanan medis</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Section Pendidikan -->

    <!-- Section Kenapa Pilih -->
    <section class="keunggulan py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Kenapa Pilih Darul Abror?</h2>
            <div class="row justify-content-center">

                <!-- Kurikulum -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <h4 class="card-title mb-3">Kurikulum Terpadu</h4>
                        <p class="card-text text-muted text-uppercase">Menggabungkan pembelajaran agama klasik dan pendidikan modern untuk membentuk santri yang berilmu dan berakhlak</p>
                    </div>
                </div>

                <!-- Pembinaan Ibadah -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <h4 class="card-title mb-3">Pembinaan Ibadan & Akhlak</h4>
                        <p class="card-text text-muted text-uppercase">Santri dibiasakan dengan ibadah harian dan pembinaan akhlak untuk membentuk karakter islami yang kuat</p>
                    </div>
                </div>

                <!-- Ekstra -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <h4 class="card-title mb-3">Kegiatan Ekstrakurikuler</h4>
                        <p class="card-text text-muted text-uppercase">Beragam kegiatan ekstrakurikuler membekali santri dengan keterampilank, kreativitas, dan rasa percaya diri</p>
                    </div>
                </div>

                <!-- Nyaman -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <h4 class="card-title mb-3">Lingkungan Nyaman dan Islami</h4>
                        <p class="card-text text-muted text-uppercase">Berlokasi di derah sejuk dan tenang, menciptakan susana belajar yang aman, nyaman, dan religius</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Section Kenapa Pilih -->

    <!-- Section Statistik -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center text-center">

                <!-- Santri aktif -->
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">350</div>
                        <div class="stats-label">Jumlah Santri Aktif</div>
                    </div>
                </div>

                <!-- Alumni -->
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">1240</div>
                        <div class="stats-label">Alumni Telah Lulus</div>
                    </div>
                </div>

                <!-- Hafid -->
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">85</div>
                        <div class="stats-label">Santri Hafidz Al-Qur'an</div>
                    </div>
                </div>

                <!-- Pendaftar -->
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <div class="stats-number">217</div>
                        <div class="stats-label">Jumlah Pendaftar Tahun Ini</div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Section Statistik -->

    <!-- Section Pengenalan -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-3 fw-bold">Bergabung Bersama Kami</h2>
            <p class="text-center mb-5">Siapkan masa depanmu dengan menuntut ilmu di Pondok Pesantren Darul Abror yang membina ilmu, iman, dan akhlak dalam suasana islami</p>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="video-container">
                        <iframe
                            src="https://www.youtube.com/embed/FsnZmz6tq5o"
                            title="PROFIL UNIVERSITAS AMIKOM PURWOKERTO 2024"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Pengenalan -->

    <!-- Section Pendaftaran -->
    <section class="pendaftaran py-5" id="pendaftaran">
        <div class="container rounded shadow-sm mb-5">
            <div class=" text-center p-5 ">
                <h1 class="fw-bold mb-3">PENDAFTARAN SANTRI BARU TELAH DIBUKA</h1>
                <p class="mb-4">Tahun Ajaran 1446/1447 H atau 2025/2026 M</p>
                <p>Silahkan <strong>KLIK</strong> tombol <strong>“DAFTAR”</strong> dibawah ini untuk pendaftaran santri baru secara online</p>
                <a href="{{ route('user.auth.register') }}" target="_blank" class="btn fw-bold px-4 py-2 mt-3">DAFTAR</a>
            </div>
        </div>
    </section>
    <!-- Section Pendaftaran -->

    <!-- Section Kontak -->
    <section class="py-5" id="kontak">
        <div class="container">
            <div class="row">
                <!-- Form Kontak -->
                <div class="col-md-6 mb-4">
                    <h2 class="fw-bold mb-4">Contact</h2>
                    <form class="contact-form" id="contactForm">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="nama" placeholder="Nama" required class="form-control">
                            <div class="invalid-feedback" id="error-nama"></div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" placeholder="E-mail" required class="form-control">
                            <div class="invalid-feedback" id="error-email"></div>
                        </div>
                        <div class="mb-3">
                            <textarea name="pesan" rows="5" placeholder="Pesan" required class="form-control"></textarea>
                            <div class="invalid-feedback" id="error-pesan"></div>
                        </div>
                        <p class="text-muted small mb-3">*NB anda tidak perlu login untuk mengisi kritik dan saran</p>
                        <button type="submit" class="btn px-4" id="submitBtn">
                            <span class="btn-text">Kirim</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </form>

                    <!-- Alert untuk feedback -->
                    <div id="contactAlert" class="alert d-none mt-3" role="alert"></div>
                </div>

                <!-- Info Kontak -->
                <div class="col-md-6">
                    <h2 class="fw-bold mb-4">Pondok Pesantren Darul Abror</h2>
                    <div class="contact-info">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-map-marker-alt"></i>
                            <p class="mb-0">Jl. Letjend Pol. Soemarto Gg. XIV, RT.07/RW.03, Watumas, Purwanegara, Kec. Purwokerto Utara, Kab. Banyumas, Jawa Tengah 53217 (61262)</p>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-phone"></i>
                            <p class="mb-0">Telepon: (031) 8977007</p>
                        </div>
                        <div class="d-flex align-items-start mb-4">
                            <i class="fas fa-envelope"></i>
                            <p class="mb-0">Email: darulabror@gmail.com</p>
                        </div>

                        <!-- Google Maps -->
                        <div class="mt-4">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.586346527194!2d109.22755917442703!3d-7.400158872862889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655e54712406c1%3A0xcb752435b1838824!2sPondok%20Pesantren%20Darul%20Abror!5e0!3m2!1sid!2sid!4v1749117571424!5m2!1sid!2sid"
                                width="100%"
                                height="300"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- Section Kontak -->

@push('scripts')
<script>
    $(document).ready(function() {
        $('#contactForm').on('submit', function(e) {
            e.preventDefault();

            // Reset validation states
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#contactAlert').addClass('d-none');

            // Show loading state
            const submitBtn = $('#submitBtn');
            const btnText = submitBtn.find('.btn-text');
            const spinner = submitBtn.find('.spinner-border');

            submitBtn.prop('disabled', true);
            btnText.text('Mengirim...');
            spinner.removeClass('d-none');

            // Get form data
            const formData = new FormData(this);

            // Send AJAX request
            $.ajax({
                url: '{{ route("contact.store") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        $('#contactAlert')
                            .removeClass('d-none alert-danger')
                            .addClass('alert-success')
                            .text(response.message);

                        // Reset form
                        $('#contactForm')[0].reset();

                        // Scroll to alert
                        $('html, body').animate({
                            scrollTop: $('#contactAlert').offset().top - 100
                        }, 500);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validation errors
                        const errors = xhr.responseJSON.errors;

                        // Show field-specific errors
                        $.each(errors, function(field, messages) {
                            const input = $('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            $('#error-' + field).text(messages[0]);
                        });

                        // Show general error message
                        $('#contactAlert')
                            .removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .text('Mohon periksa kembali data yang Anda masukkan.');
                    } else {
                        // General error
                        $('#contactAlert')
                            .removeClass('d-none alert-success')
                            .addClass('alert-danger')
                            .text('Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
                    }

                    // Scroll to alert
                    $('html, body').animate({
                        scrollTop: $('#contactAlert').offset().top - 100
                    }, 500);
                },
                complete: function() {
                    // Reset loading state
                    submitBtn.prop('disabled', false);
                    btnText.text('Kirim');
                    spinner.addClass('d-none');
                }
            });
        });
    });
</script>
@endpush
@endsection