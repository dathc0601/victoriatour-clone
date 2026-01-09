@extends('layouts.app')

@section('title', __('navigation.destinations'))
@section('meta_description', 'Explore our destinations across Southeast Asia. Vietnam, Thailand, Cambodia, Laos, and more await your discovery.')

@section('content')
    <!-- Hero Section - Full viewport atmospheric hero -->
    <section class="destinations-hero relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=2000&q=80"
                 alt="Southeast Asian landscape"
                 class="w-full h-full object-cover"
                 loading="eager">
            <!-- Gradient Overlays for depth -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/20 to-black/50"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center text-white px-4 max-w-5xl mx-auto"
             data-aos="fade-up"
             data-aos-duration="1000">
            <h1 class="text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-heading font-bold uppercase tracking-[0.15em] mb-6 drop-shadow-2xl">
                {{ __('navigation.destinations') }}
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl text-white/90 max-w-3xl mx-auto leading-relaxed font-light tracking-wide">
                Lauded for its extensive knowledge, its East-meets-West model and venturing responsibly into every corner of its destinations, it is our mission to show guests the beating heart of our Asia
            </p>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
            <svg class="w-6 h-6 text-gray/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Explore Destinations Section -->
    <section class="py-20 md:py-28 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-16 md:mb-20"
                 data-aos="fade-up"
                 data-aos-duration="800">
                <!-- Bird Icon -->
                <div class="mb-6">
                    <img src="{{ asset('images/logo-icon.svg') }}"
                         class="w-10 h-10 md:w-12 md:h-12 mx-auto">
                </div>
                <!-- Section Title -->
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-primary-900 tracking-wide">
                    Explore Destinations
                </h2>
            </div>

            <!-- Destinations Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12 md:gap-y-16">
                @foreach($destinations as $index => $destination)
                    <x-destination-card
                        :destination="$destination"
                        :position="$index + 1"
                        variant="explore" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section - Refined styling -->
    <section class="py-20 md:py-24 bg-primary-900 text-white relative overflow-hidden">
        <!-- Subtle pattern overlay -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10"
             data-aos="fade-up"
             data-aos-duration="800">
            <h2 class="text-3xl md:text-4xl font-heading font-bold mb-5 tracking-wide">
                Can't Find What You're Looking For?
            </h2>
            <p class="text-white/80 mb-10 max-w-2xl mx-auto text-lg leading-relaxed">
                Let us create a custom itinerary tailored to your preferences and travel style.
            </p>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-3 px-10 py-4 bg-accent-500 text-white font-medium rounded-full
                      hover:bg-accent-400 hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl
                      text-lg tracking-wide">
                Contact Us
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
@endsection
