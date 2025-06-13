@extends('layouts.app')

@section('title', 'Kontak - Pondok Pesantren Darul Abror')

@section('content')
<div class="kontak">
    <!-- Section Kontak -->
    <section class="kontak py-5" id="kontak">
        <div class="container">
            <div class="row">
                <!-- Form Kontak -->
                <div class="col-md-6 mb-4">
                    <h2 class="fw-bold mb-4">Kontak</h2>
                    <form>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="5" placeholder="Pesan" required></textarea>
                        </div>
                        <p class="text-muted small mb-3">*NB anda tidak perlu login untuk mengisi kritik dan saran</p>
                        <button type="submit" class="btn btn-success px-4">Kirim</button>
                    </form>
                </div>

                <!-- Info Kontak -->
                <div class="col-md-6">
                    <h2 class="fw-bold mb-4">Pondok Pesantren Darul Abror</h2>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-map-marker-alt mt-1 me-3 text-primary mr-2"></i>
                        <p class="mb-0">Jl. Letjend Pol. Soemarto Gg. XIV, RT.07/RW.03, Watumas, Purwanegara, Kec. Purwokerto Utara, Kabupaten Banyumas, Jawa Tengah 53127</p>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-phone mt-1 me-3 text-primary mr-2"></i>
                        <p class="mb-0">Telepon: (031) 8977007</p>
                    </div>
                    <div class="d-flex align-items-start mb-4">
                        <i class="fas fa-envelope mt-1 me-3 text-primary mr-2"></i>
                        <p class="mb-0">Email: ponpesdarulabrorpurwokerto@gmail.com</p>
                    </div>

                    <!-- Google Maps -->
                    <div class="mt-4">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.586346527194!2d109.22755917442703!3d-7.400158872862889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655e54712406c1%3A0xcb752435b1838824!2sPondok%20Pesantren%20Darul%20Abror!5e0!3m2!1sid!2sid!4v1749117571424!5m2!1sid!2sid"
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
    </section>
    <!-- Section Kontak -->
</div>
@endsection