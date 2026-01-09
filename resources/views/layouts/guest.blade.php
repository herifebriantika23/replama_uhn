<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ICON FONTS --}}
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:wght@600&family=Mulish:wght@300;500;600;700&display=swap" rel="stylesheet" />

    {{-- Landing Page CSS --}}
    <link href="{{ asset('homepage/css/styles.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body id="page-top">

{{-- NAVBAR GUEST --}}
@include('layouts.guest.navbar')

{{-- MAIN CONTENT --}}
@yield('content')

{{-- FOOTER --}}
@include('layouts.guest.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('homepage/js/scripts.js') }}"></script>

@stack('scripts')

</body>
</html>
