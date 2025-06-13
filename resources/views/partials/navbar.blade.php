<!-- <nav class="navbar navbar-expand-md">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo"
                class="logo img-circle elevation-3 brand-image"
                style="width: 40px; height: 40px;">
            <span class="brand-text font-weight-bold ml-2">Pondok Pesantren Darul Abror</span>
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/berita') ? 'active' : '' }}" href="{{ route('berita') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/ekstrakurikuler') ? 'active' : '' }}" href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/pendaftaran') ? 'active' : '' }}" href="{{ route('pendaftaran') }}">Pendaftaran</a>
                </li>
            </ul>
        </div>
    </div>
</nav> -->

<nav class="navbar navbar-expand-md custom-navbar">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Logo"
                class="logo img-circle elevation-3 brand-image"
                style="width: 40px; height: 40px;">
            <span class="brand-text font-weight-bold ml-2">Pondok Pesantren Darul Abror</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}" href="{{ route('berita') }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('ekstrakurikuler') ? 'active' : '' }}" href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pendaftaran') ? 'active' : '' }}" href="{{ route('pendaftaran') }}">Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>