<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website Santri')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/user/main.css') }}">
</head>

<body>

    <div class="py-5">
        @yield('content')
    </div>

</body>

</html>