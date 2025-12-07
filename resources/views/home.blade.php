@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', 'Victoria Tour - Your trusted travel partner for unforgettable journeys across Southeast Asia. Discover Vietnam, Thailand, Cambodia, and more.')

@section('content')
    <!-- Hero Slider -->
    <x-hero-slider :sliders="$sliders" />

    <!-- Featured Tours (Inspirations Style) - Moved to right after hero -->
    <section class="py-16 bg-white overflow-hidden">
        <div class="container mx-auto px-4">
            <x-section-title
                icon="images/logo-icon.svg"
                :title="__('messages.home.featured_tours')"
                :subtitle="__('messages.home.featured_tours_desc')"
            />
        </div>

        <!-- Slider Container -->
        <div class="relative mt-12 px-4 lg:px-12">
            <!-- Swiper Slider -->
            <div class="swiper tours-slider" id="toursSlider">
                <div class="swiper-wrapper">
                    @foreach($featuredTours as $tour)
                        <div class="swiper-slide">
                            <x-tour-card :tour="$tour" />
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Navigation Arrows (Always Visible) -->
            <button class="tours-slider-prev absolute left-0 lg:-left-2 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white shadow-lg rounded-full flex items-center justify-center text-gray-600 hover:bg-primary-500 hover:text-white transition-all duration-300 hover:shadow-xl hover:scale-110 disabled:opacity-40 disabled:cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button class="tours-slider-next absolute right-0 lg:-right-2 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white shadow-lg rounded-full flex items-center justify-center text-gray-600 hover:bg-primary-500 hover:text-white transition-all duration-300 hover:shadow-xl hover:scale-110 disabled:opacity-40 disabled:cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            <!-- Scrollbar -->
            <div class="tours-slider-scrollbar mt-10 mx-auto max-w-lg"></div>
        </div>
    </section>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('#toursSlider', {
            modules: [SwiperModules.Navigation, SwiperModules.Scrollbar],
            slidesPerView: 1,
            spaceBetween: 20,
            grabCursor: true,
            navigation: {
                nextEl: '.tours-slider-next',
                prevEl: '.tours-slider-prev',
            },
            scrollbar: {
                el: '.tours-slider-scrollbar',
                draggable: true,
                hide: false,
            },
            breakpoints: {
                480: { slidesPerView: 1.5, spaceBetween: 16 },
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 24 },
                1280: { slidesPerView: 4, spaceBetween: 24 },
            }
        });
    });
    </script>
    @endpush

    <!-- Differentiators Section (What Makes Us Different) -->
    <section class="different-section relative py-20 overflow-hidden">
        <!-- Decorative Backgrounds -->
        <img src="{{ asset('images/bg-different-right.svg') }}"
             alt=""
             class="absolute top-0 right-0 w-auto pointer-events-none"
             aria-hidden="true">

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 lg:gap-12 items-center">
                <!-- Left Column: Title -->
                <div class="lg:col-span-1 text-center lg:text-left" data-aos="fade-right">
                    <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-normal text-gray-800 leading-tight mb-5">
                        {{ __('messages.home.why_choose_us') }}
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-base">
                        {{ __('messages.home.why_choose_us_desc') }}
                    </p>
                </div>

                <!-- Right Column: Icons Grid -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 lg:gap-10">
                        @foreach($differentiators as $item)
                            <x-differentiator-card :differentiator="$item" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Destinations - Bento Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <x-section-title
                :title="__('messages.home.popular_destinations')"
                :subtitle="__('messages.home.popular_destinations_desc')"
            />

            <!-- Bento Grid Layout -->
            <div class="destinations-bento mt-12">
                @foreach($featuredDestinations as $index => $destination)
                    <x-destination-card
                        :destination="$destination"
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
