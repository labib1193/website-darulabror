<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pondok Pesantren Darul Abror') </title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/global/logo.png') }}">
    <!-- CSS untuk Website Publik -->
    <link rel="stylesheet" href="{{ asset('assets/css/public/main.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">

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

    <!-- jQuery (wajib sebelum Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 4.6.2 Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Script Bootstrap Js
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> -->

    <!-- jQuery CDN -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- Bootstrap Bundle CDN -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

    <script>

    </script>


    @stack('scripts')

</body>

</html>