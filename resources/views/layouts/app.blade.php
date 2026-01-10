<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php
    $favicon = App\Models\Setting::get('favicon');
    $defaultOgImage = App\Models\Setting::get('og_image');
    $ogImageUrl = $defaultOgImage ? Storage::url($defaultOgImage) : asset('images/og-default.jpg');

    // SEO Override values (from middleware)
    $seoTitle = isset($seoOverride) && $seoOverride->title
        ? $seoOverride->title
        : View::yieldContent('title', 'Victoria Tour');

    $seoMetaDescription = isset($seoOverride) && $seoOverride->meta_description
        ? $seoOverride->meta_description
        : View::yieldContent('meta_description', 'Victoria Tour - Your trusted travel partner for unforgettable journeys across Southeast Asia');

    $seoOgTitle = isset($seoOverride) && $seoOverride->og_title
        ? $seoOverride->og_title
        : (isset($seoOverride) && $seoOverride->title ? $seoOverride->title : View::yieldContent('og_title', 'Victoria Tour'));

    $seoOgDescription = isset($seoOverride) && $seoOverride->og_description
        ? $seoOverride->og_description
        : (isset($seoOverride) && $seoOverride->meta_description ? $seoOverride->meta_description : View::yieldContent('og_description', 'Your trusted travel partner for unforgettable journeys across Southeast Asia'));

    $seoOgImage = isset($seoOverride) && $seoOverride->og_image
        ? Storage::url($seoOverride->og_image)
        : View::yieldContent('og_image', $ogImageUrl);

    $seoCanonical = isset($seoOverride) && $seoOverride->canonical_url
        ? $seoOverride->canonical_url
        : View::yieldContent('canonical', url()->current());

    $seoMetaRobots = isset($seoOverride) && $seoOverride->meta_robots
        ? $seoOverride->meta_robots
        : null;

    // Global SEO settings
    $googleVerification = App\Models\Setting::get('seo_google_verification');
    $bingVerification = App\Models\Setting::get('seo_bing_verification');
    $facebookAppId = App\Models\Setting::get('seo_facebook_app_id');
    $twitterSite = App\Models\Setting::get('seo_twitter_site');
@endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seoTitle }} - {{ config('app.name', 'Victoria Tour') }}</title>
    <meta name="description" content="{{ $seoMetaDescription }}">

    @if($seoMetaRobots)
        <meta name="robots" content="{{ $seoMetaRobots }}">
    @endif

    <!-- Search Engine Verification -->
    @if($googleVerification)
        <meta name="google-site-verification" content="{{ $googleVerification }}">
    @endif
    @if($bingVerification)
        <meta name="msvalidate.01" content="{{ $bingVerification }}">
    @endif

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ $seoCanonical }}">

    <!-- Open Graph -->
    @if($facebookAppId)
        <meta property="fb:app_id" content="{{ $facebookAppId }}">
    @endif
    <meta property="og:title" content="{{ $seoOgTitle }}">
    <meta property="og:description" content="{{ $seoOgDescription }}">
    <meta property="og:image" content="{{ $seoOgImage }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ config('app.name', 'Victoria Tour') }}">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    @if($twitterSite)
        <meta name="twitter:site" content="{{ $twitterSite }}">
    @endif
    <meta name="twitter:title" content="{{ $seoOgTitle }}">
    <meta name="twitter:description" content="{{ $seoOgDescription }}">
    <meta name="twitter:image" content="{{ $seoOgImage }}">

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

    <!-- Sticky Contact Buttons -->
    <x-sticky-contact-buttons />

    <!-- Back to Top Button -->
    <x-back-to-top />

    <!-- Cookie Consent Banner -->
    <x-cookie-consent />

    <!-- Scripts -->
    @livewireScripts
    @stack('scripts')
</body>
</html>
