@extends('layouts.auth')

@section('title', 'Login Santri - Darul Abror')

@section('content')
<div class="login-logo">
    <img src="{{ asset('assets/images/global/logo.jpg') }}" alt="Logo Darul Abror" style="max-height: 80px;">
    <br>
    <b>Login Santri</b>
</div>

<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk untuk mengakses dashboard santri</p>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('user.auth.login') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">
                            Ingat Saya
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                </div>
            </div>
        </form>

        <p class="mb-1 mt-3">
            <a href="#">Lupa password?</a>
        </p>
        <p class="mb-0">
            <a href="{{ route('user.auth.register') }}" class="text-center">Belum punya akun? Daftar di sini</a>
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