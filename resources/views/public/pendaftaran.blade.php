@extends('layouts.app')

@section('title', 'Pendaftaran - Pondok Pesantren Darul Abror')

@section('content')
<div class="pendaftaran">
    <section class="pendaftaran py-5 bg-light" id="pendaftaran">
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
    </section>
</div>
@endsection