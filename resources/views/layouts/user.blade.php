<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Dashboard Santri - Darul Abror')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/global/logo.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

    <!-- Custom User Layout CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/layouts/user-layout.css') }}">

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
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
                        <span class="d-none d-sm-inline ml-1">{{ Str::limit(Auth::user()->name ?? 'User', 15) }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.pengaturanakun') }}">
                            <i class="fas fa-cogs mr-2"></i> Pengaturan
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('user.auth.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        @include('partials.user.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header" style="padding-top: 15px; padding-bottom: 10px;">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h1 style="margin: 0; padding: 0;">@yield('page-title', 'Dashboard')</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        @include('partials.user.footer')
    </div>

    <!-- jQuery -->
    <!-- <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script> -->
    <!-- Bootstrap 4 -->
    <!-- <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 4 Bundle CDN (matching AdminLTE) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

    <!-- Custom JS -->
    <!-- <script src="{{ asset('assets/js/user/main.js') }}"></script> -->


    <!-- Session Management Script -->
    <script>
        $(document).ready(function() {
            // Initialize tooltips if any
            $('[data-toggle="tooltip"]').tooltip();

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
                        console.log('Sidebar toggle clicked, sidebar-open:', $('body').hasClass('sidebar-open'));
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
        });

        // Handle AJAX errors globally
        $(document).ajaxError(function(event, xhr, settings) {
            if (xhr.status === 401 || xhr.status === 419) {
                // Session expired
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Sesi Berakhir',
                        text: 'Sesi Anda telah berakhir. Anda akan diarahkan ke halaman login.',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        allowOutsideClick: false
                    }).then(() => {
                        window.location.href = '{{ route("user.auth.login", ["expired" => 1]) }}';
                    });
                } else {
                    alert('Sesi Anda telah berakhir. Anda akan diarahkan ke halaman login.');
                    window.location.href = '{{ route("user.auth.login", ["expired" => 1]) }}';
                }
            }
        });

        // Handle page visibility change to check session when user returns
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                // Page became visible, check if we're still authenticated
                fetch('{{ route("user.dashboard") }}', {
                    method: 'HEAD',
                    credentials: 'same-origin'
                }).catch(error => {
                    // If there's an error, redirect to login
                    window.location.href = '{{ route("user.auth.login", ["expired" => 1]) }}';
                });
            }
        });
    </script>

    @stack('scripts')
</body>

</html>