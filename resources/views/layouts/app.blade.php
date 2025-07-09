<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pondok Pesantren Darul Abror') </title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ secure_asset('assets/images/global/logo.png') }}">
    <!-- CSS untuk Website Publik -->
    <link rel="stylesheet" href="{{ secure_asset('assets/css/public/main.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ secure_asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ secure_asset('AdminLTE/dist/css/adminlte.min.css') }}">

    @stack('styles')
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        {{-- Header --}}

        <!-- Navbar  -->
        @include('partials.public.navbar')
        <!-- Navbar -->

        <!-- Konten Halaman -->
        <main class="">
            @yield('content')
        </main>
        <!-- Konten Halaman -->

        <!-- Footer -->
        @include('partials.public.footer')
        <!-- Footer -->
    </div>

    <!-- Script Bootstrap Js -->
    <!-- <script src="{{ secure_asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ secure_asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

    <script>

    </script>


    @stack('scripts')

</body>

</html>