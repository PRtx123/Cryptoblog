<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo-admin.css">

</head>
<body>
    @auth('admins')
    <header>
        @include('admin.layouts.header')
    </header>
    @endauth

    @if(\Illuminate\Support\Facades\Session::exists('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        @yield('content')
    </div>

    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
