<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Pondok Pesantren Darul Abror') </title>

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

    <!-- Script Bootstrap Js -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>

    <script>

    </script>


    @stack('scripts')

</body>

</html>