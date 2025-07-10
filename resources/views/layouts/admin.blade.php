<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')Dashboard Admin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/global/logo.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}"> <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}"> <!-- Custom Admin Layout CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/layouts/admin-layout.css') }}">

    <!-- Custom Admin CSS -->
    @vite(['resources/css/admin.css'])

    <!-- Custom CSS -->
    @stack('css')

    <!-- Profile Image Consistency CSS -->
    <style>
        .user-panel .image img {
            width: 35px !important;
            height: 35px !important;
            object-fit: cover;
            object-position: center;
            border: 2px solid #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- User Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <span class="d-none d-sm-inline ml-1">{{ Str::limit(Auth::user()->name ?? 'Admin', 15) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.settings') }}">
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
                </li>
            </ul>
        </nav>

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
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name ?? 'Admin' }}</a>
                    </div>
                </div><!-- Sidebar Menu -->
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
                        </li> <!-- Data Pembayaran -->
                        <li class="nav-item">
                            <a href="{{ route('admin.pembayaran.index') }}" class="nav-link {{ Request::is('admin/pembayaran*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill-wave"></i>
                                <p>Data Pembayaran</p>
                            </a>
                        </li>

                        <!-- Kritik & Saran -->
                        <li class="nav-item">
                            <a href="{{ route('admin.contact.index') }}" class="nav-link {{ Request::is('admin/contact*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>
                                    Kritik & Saran
                                    @if(App\Models\Contact::where('status', 'unread')->count() > 0)
                                    <span class="badge badge-warning right">{{ App\Models\Contact::where('status', 'unread')->count() }}</span>
                                    @endif
                                </p>
                            </a>
                        </li>


                        <!-- Pengaturan -->
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
                        <div class="col-12">
                            <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
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

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 4 Bundle CDN (matching AdminLTE) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- DataTables -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Mobile sidebar toggle function
            function initMobileSidebar() {
                if (window.innerWidth <= 768) {
                    $('body').addClass('sidebar-mini sidebar-collapse');

                    // Remove any existing sidebar-open class
                    $('body').removeClass('sidebar-open');

                    // Handle pushmenu click for mobile
                    $('[data-widget="pushmenu"]').off('click.mobile').on('click.mobile', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        // Toggle sidebar open state
                        $('body').toggleClass('sidebar-open');

                        // Log for debugging
                        console.log('Admin sidebar toggle clicked, sidebar-open:', $('body').hasClass('sidebar-open'));
                    });

                    // Close sidebar when clicking outside on mobile
                    $(document).off('click.mobile').on('click.mobile', function(e) {
                        if (window.innerWidth <= 768 && $('body').hasClass('sidebar-open')) {
                            if (!$(e.target).closest('.main-sidebar, [data-widget="pushmenu"]').length) {
                                $('body').removeClass('sidebar-open');
                            }
                        }
                    });
                } else {
                    // Desktop behavior
                    $('body').removeClass('sidebar-mini sidebar-collapse sidebar-open');

                    // Remove mobile event handlers
                    $('[data-widget="pushmenu"]').off('click.mobile');
                    $(document).off('click.mobile');

                    // Use AdminLTE default behavior for desktop
                    $('[data-widget="pushmenu"]').off('click.desktop').on('click.desktop', function(e) {
                        e.preventDefault();
                        // Let AdminLTE handle desktop sidebar toggle
                    });
                }
            }

            // Initialize on page load
            initMobileSidebar();

            // Handle window resize
            $(window).on('resize', function() {
                initMobileSidebar();
            });

            // Initialize Bootstrap dropdowns
            $('.dropdown-toggle').dropdown();
        });
    </script>
    @stack('js')
    @stack('scripts')
</body>

</html>