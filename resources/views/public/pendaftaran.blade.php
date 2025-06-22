@extends('layouts.app')

@section('title', 'Pendaftaran - Pondok Pesantren Darul Abror')

@section('content')
<div class="pendaftaran">
    <!-- <section class="pendaftaran py-5 bg-light" id="pendaftaran">
        <div class="container bg-white rounded shadow-sm mb-5">
            <div class=" text-center p-5 ">
                <h1 class="fw-bold mb-3">PENDAFTARAN SANTRI BARU TELAH DIBUKA</h1>
                <p class="mb-4">Tahun Ajaran 1446/1447 H atau 2025/2026 M</p>
                <p>Silahkan <strong>KLIK</strong> tombol <strong>“DAFTAR”</strong> dibawah ini untuk pendaftaran santri baru secara online</p>

                <a href="{{ route('user.auth.register') }}" target="_blank" class="btn btn-warning fw-bold px-4 py-2 mt-3">DAFTAR</a>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <p>Untuk informasi lebih lanjut mengenai pendaftaran, silahkan hubungi:</p>
                            <ul class="list-unstyled">
                                <li><strong>Telepon:</strong> (031) 8977007</li>
                                <li><strong>Email:</strong> ponpesdarulabrorpurwokerto@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Alur Pendaftaran Online -->
    <section class="alur-pendaftaran py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="color: #00712D;">Alur Pendaftaran Online</h2>
            </div>

            <!-- Progress Steps -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="d-flex justify-content-between align-items-center position-relative">
                        <!-- Connection Line -->
                        <div class="position-absolute top-50 start-0 translate-middle-y w-100" style="height: 4px; background-color: #00712D; z-index: 1;"></div>

                        <!-- Step 1 -->
                        <div class="text-center position-relative" style="z-index: 2;">
                            <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; background-color: #00712D !important;">
                                <span class="fw-bold fs-4">1</span>
                            </div>
                            <h6 class="fw-bold mb-2">Pembuatan Akun</h6>
                        </div>

                        <!-- Step 2 -->
                        <div class="text-center position-relative" style="z-index: 2;">
                            <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; background-color: #00712D !important;">
                                <span class="fw-bold fs-4">2</span>
                            </div>
                            <h6 class="fw-bold mb-2">Login & Melengkapi Data</h6>
                        </div>

                        <!-- Step 3 -->
                        <div class="text-center position-relative" style="z-index: 2;">
                            <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; background-color: #00712D !important;">
                                <span class="fw-bold fs-4">3</span>
                            </div>
                            <h6 class="fw-bold mb-2">Mengunggah Berkas</h6>
                        </div>

                        <!-- Step 4 -->
                        <div class="text-center position-relative" style="z-index: 2;">
                            <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; background-color: #00712D !important;">
                                <span class="fw-bold fs-4">4</span>
                            </div>
                            <h6 class="fw-bold mb-2">Pembayaran</h6>
                        </div>

                        <!-- Step 5 -->
                        <div class="text-center position-relative" style="z-index: 2;">
                            <div class="step-circle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; background-color: #00712D !important;">
                                <span class="fw-bold fs-4">5</span>
                            </div>
                            <h6 class="fw-bold mb-2">Cetak Pendaftaran</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step Details -->
            <div class="row g-4" style="padding-top: 70px;">
                <!-- Step 1 Detail -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="step-icon mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background-color: #00712D; color: white;">
                                    <i class="fas fa-user-plus fs-2"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: #00712D;">1. Pembuatan Akun</h5>
                            <p class="text-muted">Mengisi identitas calon peserta didik sekaligus pembuatan akun untuk mendapatkan Nomor Registrasi.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 2 Detail -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="step-icon mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background-color: #00712D; color: white;">
                                    <i class="fas fa-edit fs-2"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: #00712D;">2. Login & Melengkapi Data</h5>
                            <p class="text-muted">Melengkapi data peserta didik, data orang tua / wali atau mahrom khususnya santri putri.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 Detail -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="step-icon mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background-color: #00712D; color: white;">
                                    <i class="fas fa-upload fs-2"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: #00712D;">3. Mengunggah Berkas</h5>
                            <p class="text-muted">Mengunggah berkas persyaratan dan berkas pendukung lainnya yang berupa gambar / foto.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 4 Detail -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="step-icon mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background-color: #00712D; color: white;">
                                    <i class="fas fa-credit-card fs-2"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: #00712D;">4. Pembayaran</h5>
                            <p class="text-muted">Melakukan pembayaran biaya pendaftaran sesuai pendidikan yang telah dipilih.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 5 Detail -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="step-icon mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background-color: #00712D; color: white;">
                                    <i class="fas fa-print fs-2"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: #00712D;">5. Cetak Pendaftaran</h5>
                            <p class="text-muted">Cetak atau simpan Nomor Registrasi sebagai bukti pendaftaran untuk ditunjukkan ke petugas PSB.</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm" style="background-color:rgba(255, 145, 0, 0.1);">
                        <div class="card-body text-center p-4">
                            <div class="step-icon mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; background-color: #FF9100; color: white;">
                                    <i class="fas fa-info-circle fs-2"></i>
                                </div>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: #FF9100;">Informasi Penting</h5>
                            <p class="text-muted">Pastikan semua data yang diisi sudah benar dan berkas yang diunggah sesuai dengan ketentuan yang berlaku.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-5">
                <div class="card border-0" style="background: linear-gradient(135deg, #00712D 0%, #FF9100 100%);">
                    <div class="card-body py-4">
                        <h4 class="text-white fw-bold mb-3">Siap Memulai Pendaftaran?</h4>
                        <p class="text-white mb-4">Ikuti langkah-langkah di atas untuk mendaftarkan putra/putri Anda di Pondok Pesantren Darul Abror</p>
                        <a href="{{ route('user.auth.register') }}" target="_blank" class="btn btn-warning btn-lg fw-bold px-5 py-3">
                            <i class="fas fa-user-plus me-2"></i>MULAI PENDAFTARAN
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection