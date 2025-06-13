@extends('layouts.user')

@section('content')
<div class="registeruser">
    <div class="register-container">
        <div class="register-box mx-auto">

            {{-- Logo dan Judul --}}
            <div class="logo-container">
                <img src="{{ asset('assets/images/global/logo.jpg') }}" alt="Logo" class="logo">
                <p class="title">Daftar Santri Baru</p>
            </div>

            {{-- Error message --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('user.auth.register') }}" class="register-form">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="btn-daftar">Daftar</button>
            </form>

            {{-- Link ke login --}}
            <div class="login-link">
                <p>Sudah punya akun? <a href="{{ route('user.auth.login') }}">Masuk di sini</a></p>
            </div>

        </div>
    </div>
</div>
@endsection