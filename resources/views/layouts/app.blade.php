<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Handmade Jewelry') }}</title>
    <meta name="description" content="@yield('meta_description', 'Gioielli artigianali fatti a mano per ogni occasione speciale. Rosari, braccialetti e collane per Battesimo, Comunione, Matrimonio e altro.')">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Head -->
    @stack('head')
</head>
<body class="min-h-screen flex flex-col bg-primary-200 text-content antialiased">
    <!-- Skip to Content (Accessibility) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-secondary-300 px-4 py-2 rounded-elegant z-50">
        Vai al contenuto principale
    </a>

    <!-- Header -->
    @include('layouts.partials.header')

    <!-- Main Content -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.partials.footer')

    <!-- Alpine.js & Scripts -->
    @stack('scripts')
</body>
</html>
