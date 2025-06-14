@extends('layouts.user')

@section('content')
<div class="loginuser">
    <div class="login-page">
        <div class="login-container">
            {{-- Pesan Kesalahan --}}
            <div class="login-box">

                {{-- Logo dan Judul --}}
                <div class="logo-container">
                    <img src="{{asset('assets/images/global/logo.jpg') }}" alt="logo" class="logo">
                    <p class="title">Login Santri</p>
                </div>

                {{-- Form Login --}}
                <form method="POST" action="{{ route('user.auth.login') }}" class="login-form">
                    @csrf

                    @if ($errors->any())
                    <div class="alert alert-danger text-start">
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn-masuk">Masuk</button>
                </form>

                <!-- Link Daftar -->
                <div class="register-link">
                    <p style="color:white">Belum punya akun? <a href="{{ route('user.auth.register') }}" class="help-link">Daftar disini</a></p>
                </div>

                <!-- Links -->
                <div class="help-links">
                    <a href="#" class="help-link">Video Panduan Pendaftaran Santri Baru</a>
                    <a href="#" class="help-link">Download Brosur Untuk Santri Baru</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection