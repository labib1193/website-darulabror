<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4"> <!-- Brand Logo -->
    <a href="{{ route('user.identitas') }}" class="brand-link">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; max-height: 33px;">
        <span class="brand-text font-weight-light">Dashboard Santri</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar"> <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::check() && Auth::user() ? Auth::user()->name : 'User' }}</a>
            </div>
        </div><!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Identitas Diri -->
                <li class="nav-item">
                    <a href="{{ route('user.identitas') }}" class="nav-link {{ request()->routeIs('user.identitas') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Identitas Diri</p>
                    </a>
                </li>

                <!-- Data Orangtua -->
                <li class="nav-item">
                    <a href="{{ route('user.orangtua') }}" class="nav-link {{ request()->routeIs('user.orangtua') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Orangtua</p>
                    </a>
                </li>

                <!-- Dokumen -->
                <li class="nav-item">
                    <a href="{{ route('user.dokumen') }}" class="nav-link {{ request()->routeIs('user.dokumen') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Dokumen</p>
                    </a>
                </li>

                <!-- Pembayaran -->
                <li class="nav-item">
                    <a href="{{ route('user.pembayaran') }}" class="nav-link {{ request()->routeIs('user.pembayaran') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>

                <!-- Pengaturan Akun -->
                <li class="nav-item">
                    <a href="{{ route('user.pengaturanakun') }}" class="nav-link {{ request()->routeIs('user.pengaturanakun') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan Akun</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('user.auth.logout') }}" style="margin: 0;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-left" style="width: 100%; border: none; background: none; color: #c2c7d0;">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>