<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ secure_asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ secure_asset('AdminLTE/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>403 Error Page</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="error-page">
                    <h2 class="headline text-warning"> 403</h2>

                    <div class="error-content">
                        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Akses Ditolak.</h3>

                        <p>
                            Anda tidak memiliki izin untuk mengakses halaman ini.
                            Halaman ini hanya dapat diakses oleh administrator.
                            Anda dapat <a href="{{ route('admin.login') }}">login sebagai admin</a> atau kembali ke <a href="{{ route('beranda') }}">halaman utama</a>.
                        </p>

                        <div class="row mt-4">
                            <div class="col-6">
                                <a href="{{ route('admin.login') }}" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Login Admin
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('beranda') }}" class="btn btn-secondary">
                                    <i class="fas fa-home"></i> Halaman Utama
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ secure_asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ secure_asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ secure_asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>

</html>