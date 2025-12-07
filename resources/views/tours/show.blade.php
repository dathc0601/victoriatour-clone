@extends('layouts.app')

@section('title', $tour->title)
@section('meta_description', $tour->meta_description ?? $tour->excerpt ?? Str::limit(strip_tags($tour->description), 160))
@section('canonical', route('tours.show', $tour->slug))
@section('og_title', $tour->title . ' | Victoria Tour')
@section('og_description', $tour->excerpt ?? Str::limit(strip_tags($tour->description), 160))
@section('og_type', 'product')

@php
    $featuredImage = $tour->getFirstMediaUrl('featured_image') ?: 'https://picsum.photos/seed/tour' . $tour->id . '/1920/1080';
    $galleryImages = $tour->getMedia('gallery')->map(fn($media) => $media->getUrl())->toArray();
@endphp

@section('og_image', $featuredImage)

@push('json-ld')
    <x-json-ld type="tour" :data="$tour" />
@endpush

@section('content')
    <div x-data="tourDetailTabs()">
        {{-- ==========================================
            HERO SECTION - Full Viewport
        ========================================== --}}
        <section class="tour-hero relative h-screen flex items-end pb-32" data-hero>
            {{-- Background Image --}}
            <div class="absolute inset-0">
                <img
                    src="{{ $featuredImage }}"
                    alt="{{ $tour->title }}"
                    class="w-full h-full object-cover"
                    loading="eager"
                >
                {{-- Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>
            </div>

            {{-- Hero Content --}}
            <div class="relative z-10 container mx-auto px-4">
                {{-- Breadcrumb --}}
                <div class="mb-6 [&_nav]:py-0 [&_a]:text-gray-300 [&_a:hover]:text-white [&_span]:text-white [&_svg]:text-gray-400">
                    <x-breadcrumbs :items="[
                        ['name' => __('navigation.tours'), 'url' => route('tours.index')],
                        ['name' => $tour->destination->name, 'url' => route('tours.destination', $tour->destination->slug)],
                        ['name' => $tour->title]
                    ]" />
                </div>

                {{-- Category Badges --}}
                <div class="flex flex-wrap gap-2 mb-4" data-aos="fade-up" data-aos-delay="100">
                    @foreach($tour->categories as $category)
                        <span class="px-4 py-1.5 bg-accent-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-full shadow-lg">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>

                {{-- Tour Title --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-white mb-6 drop-shadow-lg max-w-4xl" data-aos="fade-up" data-aos-delay="200">
                    {{ $tour->title }}
                </h1>

                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-6 text-white/90 mb-8" data-aos="fade-up" data-aos-delay="300">
                    {{-- Location --}}
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $tour->destination->name }}@if($tour->city), {{ $tour->city->name }}@endif
                    </span>

                    {{-- Duration --}}
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $tour->duration_days }} {{ $tour->duration_days > 1 ? __('messages.tour_detail.days') : __('messages.tour_detail.day') }}
                    </span>

                    {{-- Rating --}}
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                        </svg>
                        {{ number_format($tour->rating, 1) }}
                    </span>
                </div>

                {{-- Social Share --}}
                <div data-aos="fade-up" data-aos-delay="400">
                    <x-social-share :url="route('tours.show', $tour->slug)" :title="$tour->title" size="sm" />
                </div>
            </div>

            {{-- Scroll Indicator --}}
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 text-center scroll-indicator">
                <svg class="w-8 h-8 text-dark/70 mx-auto animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </section>

        {{-- ==========================================
            STICKY TABS NAVIGATION
        ========================================== --}}
        <div class="tour-tabs-wrapper bg-white border-b border-gray-200" :class="{ 'is-sticky shadow-md': isSticky }">
            <div class="container mx-auto px-4">
                <nav class="flex items-center justify-center gap-2 md:gap-4 md:py-4 overflow-x-auto">
                    <template x-for="tab in tabs" :key="tab.id">
                        <button
                            @click="scrollToSection(tab.id)"
                            :class="activeTab === tab.id ? 'text-primary-600 border-b-2 border-amber-500 opacity-100' : 'text-gray-600 hover:text-primary-600 opacity-60'"
                            class="flex flex-col items-center gap-2 px-4 py-2 font-medium transition-all min-w-[80px] cursor-pointer opacity-60 hover:opacity-100"
                        >
                            <span x-html="tab.icon" class="w-8 h-8"></span>
                            <span x-text="tab.label" class="text-sm whitespace-nowrap"></span>
                        </button>
                    </template>
                </nav>
            </div>
        </div>

        {{-- ==========================================
            OVERVIEW SECTION
        ========================================== --}}
        <section id="section-overview" class="py-20 tour-section-overview">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    {{-- Main Content --}}
                    <div class="lg:col-span-2">
                        {{-- Section Title --}}
                        <div class="mb-10" data-aos="fade-up">
                            <div class="flex items-center gap-4 mb-6">
                                <img src="{{ asset('images/logo-icon.svg') }}" class="w-10 h-10 drop-shadow" alt="">
                                <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900">
                                    {{ __('messages.tour_detail.overview') }}
                                </h2>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="prose prose-lg max-w-none text-gray-600" data-aos="fade-up" data-aos-delay="100">
                            {!! $tour->description !!}
                        </div>
                    </div>

                    {{-- Booking Sidebar (Desktop) --}}
                    <div class="hidden lg:block">
                        <div class="tour-booking-card p-6 sticky top-[180px]" data-aos="fade-left">
                            {{-- Price Display --}}
                            <div class="tour-price-display text-center">
                                @if($tour->price_type === 'contact')
                                    <span class="text-lg text-gray-600">{{ __('messages.tour_detail.contact_price') }}</span>
                                @else
                                    <span class="block text-sm text-gray-500 mb-1">
                                        {{ $tour->price_type === 'from' ? __('messages.tour_detail.from_price') : '' }}
                                    </span>
                                    <div class="text-4xl font-bold text-accent-600">${{ number_format($tour->price) }}</div>
                                    <span class="text-sm text-gray-500">{{ __('messages.tour_detail.per_person') }}</span>
                                @endif
                            </div>

                            {{-- Book Button --}}
                            <a href="{{ route('contact') }}?tour={{ $tour->slug }}"
                               class="tour-book-button block w-full px-6 py-4 bg-accent-500 text-white text-center font-semibold rounded-xl hover:bg-accent-600 transition shadow-lg hover:shadow-xl mb-4">
                                {{ __('messages.tour_detail.book_now') }}
                            </a>

                            {{-- Ask Question --}}
                            <a href="{{ route('contact') }}"
                               class="block w-full px-6 py-3 border-2 border-primary-500 text-primary-600 text-center font-medium rounded-xl hover:bg-primary-500 hover:text-white transition">
                                {{ __('messages.tour_detail.ask_question') }}
                            </a>

                            {{-- Trust Badges --}}
                            <div class="mt-6 pt-6 border-t space-y-4">
                                <div class="flex items-center gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm">{{ __('messages.tour_detail.free_cancellation') }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm">{{ __('messages.tour_detail.best_price') }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm">{{ __('messages.tour_detail.support_24_7') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ==========================================
            GALLERY SECTION
        ========================================== --}}
        @if(count($galleryImages) > 0 || $featuredImage)
        <section id="section-gallery" class="py-20 tour-section-gallery">
            <div class="container mx-auto px-4">
                {{-- Section Title --}}
                <div class="text-center mb-12" data-aos="fade-up">
                    <img src="{{ asset('images/logo-icon.svg') }}" class="w-12 h-12 mx-auto mb-4 drop-shadow" alt="">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                        {{ __('messages.tour_detail.gallery') }}
                    </h2>
                </div>

                {{-- Gallery Component --}}
                <div class="max-w-5xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <x-image-gallery
                        :featured="$featuredImage"
                        :images="$galleryImages"
                        :title="$tour->title"
                        :fallback="'https://picsum.photos/seed/tour' . $tour->id . '/1920/1080'"
                    />
                </div>
            </div>
        </section>
        @endif

        {{-- ==========================================
            ITINERARY SECTION
        ========================================== --}}
        @if($tour->itinerary)
        <section id="section-itinerary" class="py-20 tour-section-itinerary">
            <div class="container mx-auto px-4">
                {{-- Section Title --}}
                <div class="text-center mb-12" data-aos="fade-up">
                    <img src="{{ asset('images/logo-icon.svg') }}" class="w-12 h-12 mx-auto mb-4 drop-shadow" alt="">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                        {{ __('messages.tour_detail.itinerary') }}
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        {{ $tour->duration_days }} {{ $tour->duration_days > 1 ? __('messages.tour_detail.days') : __('messages.tour_detail.day') }}
                        @if($tour->city) • {{ $tour->city->name }}, {{ $tour->destination->name }} @endif
                    </p>
                </div>

                {{-- Itinerary Accordion --}}
                <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    <x-itinerary-accordion :itinerary="$tour->itinerary" :duration="$tour->duration_days" />
                </div>
            </div>
        </section>
        @endif

        {{-- ==========================================
            DETAILS SECTION (Inclusions/Exclusions)
        ========================================== --}}
        @if($tour->inclusions || $tour->exclusions)
        <section id="section-details" class="py-20 tour-section-details">
            <div class="container mx-auto px-4">
                {{-- Section Title --}}
                <div class="text-center mb-12" data-aos="fade-up">
                    <img src="{{ asset('images/logo-icon.svg') }}" class="w-12 h-12 mx-auto mb-4 drop-shadow" alt="">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                        {{ __('messages.tour_detail.details') }}
                    </h2>
                </div>

                {{-- Inclusions & Exclusions Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    {{-- Inclusions --}}
                    @if($tour->inclusions)
                    <div class="tour-inclusions-card p-8" data-aos="fade-right">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-gray-900">
                                {{ __('messages.tour_detail.inclusions') }}
                            </h3>
                        </div>
                        <div class="prose prose-sm text-gray-600 [&_ul]:list-none [&_ul]:pl-0 [&_li]:flex [&_li]:items-start [&_li]:gap-2 [&_li]:mb-3 [&_li:before]:content-['✓'] [&_li:before]:text-green-500 [&_li:before]:font-bold">
                            {!! $tour->inclusions !!}
                        </div>
                    </div>
                    @endif

                    {{-- Exclusions --}}
                    @if($tour->exclusions)
                    <div class="tour-exclusions-card p-8" data-aos="fade-left">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-heading font-bold text-gray-900">
                                {{ __('messages.tour_detail.exclusions') }}
                            </h3>
                        </div>
                        <div class="prose prose-sm text-gray-600 [&_ul]:list-none [&_ul]:pl-0 [&_li]:flex [&_li]:items-start [&_li]:gap-2 [&_li]:mb-3 [&_li:before]:content-['✗'] [&_li:before]:text-red-500 [&_li:before]:font-bold">
                            {!! $tour->exclusions !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
        @endif

        {{-- ==========================================
            RELATED TOURS SECTION
        ========================================== --}}
        @if($relatedTours->count())
        <section id="section-related" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                {{-- Section Title with Accent Bar --}}
                <div class="flex items-center gap-4 mb-10" data-aos="fade-up">
                    <div class="w-1.5 h-10 bg-red-500 rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900">
                        {{ __('messages.tour_detail.related') }}
                    </h2>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- Swiper Carousel --}}
                <div class="relative px-4 lg:px-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper related-tours-slider" id="relatedToursSlider">
                        <div class="swiper-wrapper">
                            @foreach($relatedTours as $related)
                                <div class="swiper-slide">
                                    <x-tour-card :tour="$related" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Navigation Buttons --}}
                    <button class="related-tours-prev absolute left-0 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-50 transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="related-tours-next absolute right-0 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-primary-50 transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    {{-- Scrollbar --}}
                    <div class="related-tours-scrollbar"></div>
                </div>
            </div>
        </section>
        @endif

        {{-- ==========================================
            MOBILE FIXED BOOKING BAR
        ========================================== --}}
        <div
            class="tour-mobile-booking-bar lg:hidden"
            :class="{ 'visible': showMobileBooking }"
        >
            <div class="flex items-center justify-between gap-4">
                {{-- Price --}}
                <div>
                    @if($tour->price_type === 'contact')
                        <span class="text-sm text-gray-600">{{ __('messages.tour_detail.contact_price') }}</span>
                    @else
                        <div class="text-2xl font-bold text-accent-600">${{ number_format($tour->price) }}</div>
                        <span class="text-xs text-gray-500">{{ __('messages.tour_detail.per_person') }}</span>
                    @endif
                </div>

                {{-- Book Button --}}
                <a href="{{ route('contact') }}?tour={{ $tour->slug }}"
                   class="flex-1 max-w-[200px] px-6 py-3 bg-accent-500 text-white text-center font-semibold rounded-xl hover:bg-accent-600 transition shadow-lg">
                    {{ __('messages.tour_detail.book_now') }}
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Related Tours Swiper
        if (document.getElementById('relatedToursSlider')) {
            new Swiper('#relatedToursSlider', {
                modules: [SwiperModules.Navigation, SwiperModules.Scrollbar],
                slidesPerView: 1,
                spaceBetween: 20,
                grabCursor: true,
                navigation: {
                    nextEl: '.related-tours-next',
                    prevEl: '.related-tours-prev',
                },
                scrollbar: {
                    el: '.related-tours-scrollbar',
                    draggable: true,
                },
                breakpoints: {
                    480: { slidesPerView: 1.5, spaceBetween: 16 },
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 24 },
                    1280: { slidesPerView: 4, spaceBetween: 24 },
                }
            });
        }
    });
</script>
@endpush
