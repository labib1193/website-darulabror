<nav class="navbar navbar-expand-md custom-navbar fixed-top">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <img
                src="{{ asset('assets/images/global/logo.png') }}"
                alt="Logo"
                class="logo brand-image"
                style="width: 60px; height: 60px;">
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('profil*') ? 'active' : '' }}" href="#" id="profilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profil
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profilDropdown">
                        <a class="dropdown-item {{ request()->routeIs('profil.sambutan') ? 'active' : '' }}" href="{{ route('profil.sambutan') }}">Sambutan</a>
                        <a class="dropdown-item {{ request()->routeIs('profil.sejarah') ? 'active' : '' }}" href="{{ route('profil.sejarah') }}">Sejarah</a>
                        <a class="dropdown-item {{ request()->routeIs('profil.visi-misi') ? 'active' : '' }}" href="{{ route('profil.visi-misi') }}">Visi Misi</a>
                        <a class="dropdown-item {{ request()->routeIs('profil.ekstrakurikuler') ? 'active' : '' }}" href="{{ route('profil.ekstrakurikuler') }}">Ekstrakurikuler</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('berita') ? 'active' : '' }}" href="{{ route('berita') }}">Berita</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('kurikulum*') ? 'active' : '' }}" href="#" id="kurikulumDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kurikulum
                    </a>
                    <div class="dropdown-menu" aria-labelledby="kurikulumDropdown">
                        <a class="dropdown-item {{ request()->routeIs('kurikulum.tpq') ? 'active' : '' }}" href="{{ route('kurikulum.tpq') }}">TPQ</a>
                        <a class="dropdown-item {{ request()->routeIs('kurikulum.madrasah-diniyah') ? 'active' : '' }}" href="{{ route('kurikulum.madrasah-diniyah') }}">Madrasah Diniyah</a>
                        <a class="dropdown-item {{ request()->routeIs('kurikulum.bq-pi') ? 'active' : '' }}" href="{{ route('kurikulum.bq-pi') }}">BQ-PI</a>
                    </div>
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