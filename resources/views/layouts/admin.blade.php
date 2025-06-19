<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Darul Abror</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"> <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}"> <!-- Custom CSS for Admin Layout Without Navbar -->
    <style>
        /* AGGRESSIVE CSS RESET - Remove all top spacing */
        body,
        html {
            margin: 0 !important;
            padding: 0 !important;
            height: 100vh !important;
        }

        .wrapper {
            margin: 0 !important;
            padding: 0 !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
        }

        /* Force content to start from absolute top */
        body.layout-fixed .content-wrapper {
            position: absolute !important;
            top: 0 !important;
            left: 250px !important;
            right: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Remove any top spacing from content header */
        .content-wrapper .content-header {
            padding-top: 20px !important;
            margin-top: 0 !important;
            padding-bottom: 40px !important;
        }

        /* Remove container fluid padding */
        .content-header .container-fluid {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* Adjust row spacing */
        .content-header .row {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        /* Ensure no spacing from body/wrapper */
        body.layout-fixed {
            padding-top: 0 !important;
        }

        .wrapper {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* Remove any AdminLTE default navbar spacing */
        body.layout-fixed .main-header {
            display: none !important;
            /* Completely hide any navbar remnants */
        }

        /* Override any AdminLTE navbar-related margins */
        body.layout-navbar-fixed .content-wrapper,
        body.layout-sm-navbar-fixed .content-wrapper,
        body.layout-md-navbar-fixed .content-wrapper,
        body.layout-lg-navbar-fixed .content-wrapper,
        body.layout-xl-navbar-fixed .content-wrapper {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* Sidebar adjustment - stick to very top */
        body.layout-fixed .main-sidebar {
            position: fixed;
            top: 0 !important;
            height: 100vh;
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        /* Remove brand link top spacing */
        .main-sidebar .brand-link {
            margin-top: 0 !important;
            padding-top: 10px !important;
        }

        /* Hide preloader completely */
        .preloader {
            display: none !important;
        }

        /* Ensure h1 title has no top margin */
        .content-header h1 {
            margin-top: 0 !important;
            padding-top: 5px !important;
        }

        /* Content header icons styling */
        .content-header .btn-group .btn {
            border-radius: 20px !important;
            margin-right: 5px;
        }

        .content-header .dropdown-menu {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .content-header .badge-pill {
            font-size: 0.7rem;
        }

        /* Notification dropdown styling */
        .dropdown-menu .media {
            padding: 0.5rem 1rem;
        }

        .dropdown-menu .media .img-size-50 {
            width: 40px;
            height: 40px;
        }

        /* Mobile responsive */
        @media (max-width: 767.98px) {
            body.layout-fixed .content-wrapper {
                margin-left: 0;
            }

            .content-header .btn-group .btn span {
                display: none !important;
            }
        }
    </style>

    <!-- Custom CSS -->
    @stack('css')
</head>

<body class="hold-transition layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div> <!-- Navbar removed for testing -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4"> <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('assets/images/global/logo.jpg') }}" alt="Darul Abror Logo" class="brand-image img-circle elevation-3" style="opacity: .8; max-height: 33px;">
                <span class="brand-text font-weight-light">Darul Abror</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name ?? 'Admin' }}</a>
                    </div>
                </div> <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Manajemen User -->
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Manajemen User</p>
                            </a>
                        </li>

                        <!-- Data Identitas -->
                        <li class="nav-item">
                            <a href="{{ route('admin.identitas.index') }}" class="nav-link {{ Request::is('admin/identitas*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-id-card"></i>
                                <p>Data Identitas</p>
                            </a>
                        </li>

                        <!-- Data Orangtua/Wali -->
                        <li class="nav-item">
                            <a href="{{ route('admin.orangtua.index') }}" class="nav-link {{ Request::is('admin/orangtua*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-friends"></i>
                                <p>Data Orangtua/Wali</p>
                            </a>
                        </li>

                        <!-- Data Dokumen -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dokumen.index') }}" class="nav-link {{ Request::is('admin/dokumen*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Data Dokumen</p>
                            </a>
                        </li>

                        <!-- Data Pembayaran -->
                        <li class="nav-item">
                            <a href="{{ route('admin.pembayaran.index') }}" class="nav-link {{ Request::is('admin/pembayaran*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>Data Pembayaran</p>
                            </a>
                        </li> <!-- Pengaturan -->
                        <li class="nav-item">
                            <a href="{{ route('admin.settings') }}" class="nav-link {{ Request::is('admin/settings*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
                        </div>
                        <div class="col-sm-4">
                            <!-- Notification and Message Icons -->
                            <div class="float-right">
                                <!-- Notifications -->
                                <div class="btn-group mr-2">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bell"></i>
                                        <span class="badge badge-warning badge-pill ml-1">15</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">15 Notifikasi</div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-users mr-2"></i> 8 pendaftar baru
                                            <span class="float-right text-muted text-sm">5 menit</span>
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-money-bill mr-2"></i> 3 pembayaran baru
                                            <span class="float-right text-muted text-sm">15 menit</span>
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-file-alt mr-2"></i> 4 dokumen pending
                                            <span class="float-right text-muted text-sm">1 jam</span>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item dropdown-footer" href="#">Lihat Semua Notifikasi</a>
                                    </div>
                                </div>

                                <!-- Messages -->
                                <div class="btn-group mr-2">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-comments"></i>
                                        <span class="badge badge-info badge-pill ml-1">3</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-header">3 Pesan</div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">
                                            <div class="media">
                                                <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                                <div class="media-body">
                                                    <h3 class="dropdown-item-title">
                                                        Ahmad Santri
                                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                                    </h3>
                                                    <p class="text-sm">Pertanyaan tentang pembayaran...</p>
                                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 2 jam yang lalu</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item dropdown-footer" href="#">Lihat Semua Pesan</a>
                                    </div>
                                </div>

                                <!-- User Menu -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                        <span class="d-none d-md-inline ml-1">{{ Auth::user()->name ?? 'Admin' }}</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user mr-2"></i> Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cogs mr-2"></i> Pengaturan
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">Darul Abror</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script> <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script> <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
    <!-- Custom JS -->
    @stack('js')
    @stack('scripts')
</body>

</html>