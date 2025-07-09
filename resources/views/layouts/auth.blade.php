<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Login Santri - Darul Abror')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ secure_asset('assets/images/global/logo.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ secure_asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ secure_asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ secure_asset('assets/css/user/auth.css') }}">

    @stack('styles')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        @yield('content')
    </div>

    <!-- jQuery
    <script src="{{ secure_asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    Bootstrap 4
    <script src="{{ secure_asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE App -->
    <script src="{{ secure_asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>


    @stack('scripts')
</body>

</html>