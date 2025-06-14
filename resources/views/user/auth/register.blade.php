@extends('layouts.auth')

@section('title', 'Daftar Santri - Darul Abror')

@section('content')
<div class="login-logo">
    <img src="{{ asset('assets/images/global/logo.jpg') }}" alt="Logo Darul Abror" style="max-height: 80px;">
    <br>
    <b>Daftar Santri Baru</b>
</div>

<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Daftar untuk menjadi santri baru</p>

        {{-- Error Messages --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('user.auth.register') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password (min. 6 karakter)" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                        <label for="agreeTerms">
                            Saya setuju dengan <a href="#">syarat dan ketentuan</a>
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </div>
            </div>
        </form>

        <p class="mb-0 mt-3">
            <a href="{{ route('user.auth.login') }}" class="text-center">Sudah punya akun? Masuk di sini</a>
        </p>

        <hr>
        <p class="text-center">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
        </p>
    </div>
</div>
@endsection