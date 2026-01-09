@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', 'Victoria Tour - Your trusted travel partner for unforgettable journeys across Southeast Asia. Discover Vietnam, Thailand, Cambodia, and more.')

@section('content')
    <!-- Hero Slider with Integrated Featured Tours -->
    <x-hero-slider :sliders="$sliders" :featuredTours="$featuredTours" />

    <!-- Differentiators Section (What Makes Us Different) -->
    <section class="different-section relative py-12 overflow-hidden">
        <!-- Decorative Backgrounds -->
        <img src="{{ asset('images/bg-different-right.svg') }}"
             alt=""
             class="absolute top-0 right-0 w-auto pointer-events-none"
             aria-hidden="true">

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-8 items-center">
                <!-- Left Column: Title -->
                <div class="lg:col-span-1 text-center lg:text-left" data-aos="fade-right">
                    <h2 class="font-heading text-2xl md:text-3xl lg:text-4xl font-normal text-gray-800 leading-tight mb-3">
                        {{ __('messages.home.why_choose_us') }}
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        {{ __('messages.home.why_choose_us_desc') }}
                    </p>
                </div>

                <!-- Right Column: Icons Grid -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 lg:gap-6">
                        @foreach($differentiators as $item)
                            <x-differentiator-card :differentiator="$item" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Destinations - Bento Grid (Cities with Recent Tours) -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <x-section-title
                :title="__('messages.home.popular_destinations')"
                :subtitle="__('messages.home.popular_destinations_desc')"
            />

            <!-- Bento Grid Layout -->
            <div class="destinations-bento mt-12">
                @foreach($featuredCities as $index => $city)
                    <x-city-bento-card
                        :city="$city"
                        :variant="match($index) {
                            0 => 'tall',
                            2 => 'large',
                            5 => 'featured',
                            default => 'standard'
                        }"
                        :position="$index + 1"
                    />
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition shadow-md hover:shadow-lg">
                    {{ __('messages.home.view_all_destinations') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-primary-500 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <span class="inline-block px-4 py-2 bg-accent-500 text-white text-sm font-medium rounded-full mb-6">{{ __('messages.home.about_badge') }}</span>
                    <h2 class="text-3xl md:text-4xl font-heading font-bold mb-6">{{ __('messages.home.about_title') }}</h2>
                    <p class="text-gray-200 text-lg mb-6 leading-relaxed">
                        {{ __('messages.home.about_p1') }}
                    </p>
                    <p class="text-gray-200 mb-8 leading-relaxed">
                        {{ __('messages.home.about_p2') }}
                    </p>
                    <a href="{{ url('/about-us') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-primary-500 font-medium rounded-lg hover:bg-gray-100 transition">
                        {{ __('messages.home.learn_more_about_us') }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div data-aos="fade-left" class="relative">
                    <img src="https://picsum.photos/seed/about/600/400" alt="Victoria Tour Team" class="rounded-2xl shadow-2xl w-full">
                    <div class="absolute -bottom-6 -left-6 bg-accent-500 text-white p-6 rounded-xl shadow-lg">
                        <div class="text-4xl font-bold">15+</div>
                        <div class="text-sm">{{ __('messages.home.years_experience') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blog Posts -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <x-section-title
                :title="__('messages.home.travel_inspiration')"
                :subtitle="__('messages.home.travel_inspiration_desc')"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
                @foreach($latestPosts as $post)
                    <x-blog-card :post="$post" />
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border-2 border-primary-500 text-primary-500 font-medium rounded-lg hover:bg-primary-500 hover:text-white transition">
                    {{ __('messages.home.read_more_articles') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="py-20 bg-gradient-to-r from-primary-500 to-primary-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-heading font-bold mb-4">{{ __('messages.home.newsletter_title') }}</h2>
                <p class="text-gray-200 mb-8 text-lg">{{ __('messages.home.newsletter_desc') }}</p>
                <div class="max-w-md mx-auto">
                    <livewire:newsletter-form />
                </div>
            </div>
        </div>
    </section>
@endsection
