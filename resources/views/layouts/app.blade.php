<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $favicon = App\Models\Setting::get('favicon');
    $defaultOgImage = App\Models\Setting::get('og_image');
    $ogImageUrl = $defaultOgImage ? Storage::url($defaultOgImage) : asset('images/og-default.jpg');
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Victoria Tour') - {{ config('app.name', 'Victoria Tour') }}</title>
    <meta name="description" content="@yield('meta_description', 'Victoria Tour - Your trusted travel partner for unforgettable journeys across Southeast Asia')">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'Victoria Tour')">
    <meta property="og:description" content="@yield('og_description', 'Your trusted travel partner for unforgettable journeys across Southeast Asia')">
    <meta property="og:image" content="@yield('og_image', $ogImageUrl)">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name', 'Victoria Tour') }}">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Victoria Tour')">
    <meta name="twitter:description" content="@yield('og_description', 'Your trusted travel partner for unforgettable journeys across Southeast Asia')">
    <meta name="twitter:image" content="@yield('og_image', $ogImageUrl)">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:500,600,700" rel="stylesheet" />

    <!-- Favicon -->
    @if($favicon)
        <link rel="icon" href="{{ Storage::url($favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')

    <!-- JSON-LD Structured Data -->
    <x-json-ld type="organization" />
    @stack('json-ld')

    <!-- Analytics -->
    <x-analytics />
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <x-analytics-noscript />

    <!-- Header -->
    <x-header />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Toast Notifications -->
    <x-toast-notifications />

    <!-- Back to Top Button -->
    <x-back-to-top />

    <!-- Cookie Consent Banner -->
    <x-cookie-consent />

    <!-- Scripts -->
    @livewireScripts
    @stack('scripts')
</body>
</html>
