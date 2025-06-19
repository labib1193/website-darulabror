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

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

    <!-- Custom CSS untuk Fixed Sidebar -->
    <style>
        /* Hanya sidebar yang fixed, navbar tetap normal */
        .layout-fixed .main-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow: hidden;
            /* Tidak ada scroll di sidebar */
            z-index: 1000;
        }

        /* Memastikan sidebar content tidak overflow */
        .layout-fixed .main-sidebar .sidebar {
            height: 100vh;
            overflow: hidden;
            /* Tidak ada scroll internal */
            padding-bottom: 0;
        }

        /* Content wrapper dengan margin untuk sidebar fixed */
        .layout-fixed .content-wrapper {
            margin-left: 250px;
        }

        /* Navbar tetap normal (tidak fixed) */
        .layout-fixed .main-header {
            margin-left: 250px;
        }

        /* Untuk mobile responsiveness */
        @media (max-width: 767.98px) {
            .layout-fixed .content-wrapper {
                margin-left: 0;
            }

            .layout-fixed .main-header {
                margin-left: 0;
            }
        }

        /* Styling untuk brand link */
        .main-sidebar .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .content-header {
            padding-top: 20px !important;
            padding-bottom: 40px !important;
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
            .content-header .btn-group .btn span {
                display: none !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition layout-fixed">
    <div class="wrapper">
        <!-- Sidebar -->
        @include('partials.user.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header" style="padding-top: 0; padding-bottom: 10px;">
                <div class="container-fluid" style="padding-top: 0;">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 style="margin: 0; padding: 0;">@yield('page-title', 'Dashboard')</h1>
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
                                        <span class="d-none d-md-inline ml-1">{{ Auth::user()->name ?? 'User' }}</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user mr-2"></i> Profile
                                        </a>
                                        <a class="dropdown-item" href="#">
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
                                </div>
                            </div>
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
    <script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/user/main.js') }}"></script>

    <!-- Session Management Script -->
    <script>
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