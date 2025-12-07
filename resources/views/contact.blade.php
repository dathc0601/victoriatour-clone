@extends('layouts.app')

@section('title', __('messages.contact_page.page_title'))
@section('meta_description', __('messages.contact_page.meta_description'))

@section('content')
    {{-- ============================================
         HERO SECTION - Full Viewport Southeast Asia Landscape
         ============================================ --}}
    <section class="contact-hero relative flex items-center justify-center" data-hero>
        {{-- Background Image --}}
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=2000&q=80"
                 alt="{{ __('messages.contact_page.hero_title') }}"
                 class="w-full h-full object-cover"
                 loading="eager">
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/30 to-black/50"></div>
        </div>

        {{-- Centered Content --}}
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            {{-- Logo Icon --}}
            <div class="mb-8" data-aos="fade-down" data-aos-delay="100">
                <img src="{{ asset('images/logo-icon.svg') }}"
                     alt="Victoria Tour"
                     class="w-16 h-16 mx-auto drop-shadow-2xl opacity-90"
                     onerror="this.style.display='none'">
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-bold text-white mb-6 drop-shadow-lg"
                data-aos="fade-up" data-aos-delay="200">
                {{ __('messages.contact_page.hero_title') }}
            </h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto leading-relaxed drop-shadow"
               data-aos="fade-up" data-aos-delay="300">
                {{ __('messages.contact_page.hero_subtitle') }}
            </p>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-10 left-1/2 contact-scroll-indicator z-20" data-aos="fade-up" data-aos-delay="600">
            <div class="flex flex-col items-center gap-2">
                <svg class="w-6 h-6 text-gray/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>
    </section>

    {{-- ============================================
         TOUR INQUIRY BANNER (Conditional)
         ============================================ --}}
    @if(isset($tour) && $tour)
    <section class="tour-inquiry-banner py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 max-w-4xl mx-auto">
                <div class="flex items-center gap-4">
                    {{-- Tour Image Thumbnail --}}
                    <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 shadow-lg">
                        @if($tour->getFirstMediaUrl('featured_image'))
                            <img src="{{ $tour->getFirstMediaUrl('featured_image', 'thumb') }}"
                                 alt="{{ $tour->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-accent-400 to-accent-600 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-accent-600 font-semibold mb-1">{{ __('messages.contact_page.inquiring_about') }}</p>
                        <h3 class="text-lg md:text-xl font-heading font-bold text-gray-900">{{ $tour->title }}</h3>
                        @if($tour->duration_days)
                            <p class="text-sm text-gray-500">{{ $tour->duration_days }} {{ __('messages.tour_detail.days') }}</p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('tours.show', $tour->slug) }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-accent-600 bg-accent-50 rounded-full hover:bg-accent-100 transition-all duration-300">
                    {{ __('messages.contact_page.view_tour_details') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ============================================
         CONTACT INFO SECTION - Glassmorphism Cards
         ============================================ --}}
    <section id="section-contact-info" class="py-20 md:py-28 bg-white">
        <div class="container mx-auto px-4">
            {{-- Section Title --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <img src="{{ asset('images/logo-icon.svg') }}"
                     alt="Victoria Tour"
                     class="w-12 h-12 mx-auto mb-6 drop-shadow opacity-80"
                     onerror="this.style.display='none'">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                    {{ __('messages.contact_page.info_title') }}
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    {{ __('messages.contact_page.info_subtitle') }}
                </p>
            </div>

            {{-- Contact Cards Grid --}}
            <div class="contact-info-grid max-w-6xl mx-auto">
                {{-- Address Card --}}
                <div class="contact-info-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="contact-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-semibold text-gray-900 text-lg mb-2">{{ __('messages.contact_page.address_label') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ App\Models\Setting::get('address', 'Ho Chi Minh City, Vietnam') }}
                    </p>
                </div>

                {{-- Phone Card --}}
                <div class="contact-info-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-semibold text-gray-900 text-lg mb-2">{{ __('messages.contact_page.phone_label') }}</h3>
                    <a href="tel:{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}"
                       class="text-gray-600 text-sm hover:text-accent-500 transition-colors duration-300">
                        {{ App\Models\Setting::get('phone', '+84 85 692 9229') }}
                    </a>
                </div>

                {{-- Email Card --}}
                <div class="contact-info-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="contact-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-semibold text-gray-900 text-lg mb-2">{{ __('messages.contact_page.email_label') }}</h3>
                    <a href="mailto:{{ App\Models\Setting::get('email', 'info@victoriatour.com') }}"
                       class="text-gray-600 text-sm hover:text-accent-500 transition-colors duration-300 break-all">
                        {{ App\Models\Setting::get('email', 'info@victoriatour.com') }}
                    </a>
                </div>

                {{-- Working Hours Card --}}
                <div class="contact-info-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="contact-card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-semibold text-gray-900 text-lg mb-2">{{ __('messages.contact_page.hours_label') }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ __('messages.contact_page.hours_weekday') }}<br>
                        {{ __('messages.contact_page.hours_saturday') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         CONTACT FORM SECTION
         ============================================ --}}
    <section id="section-form" class="contact-form-section py-20 md:py-28 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                {{-- Section Title --}}
                <div class="text-center mb-12" data-aos="fade-up">
                    <img src="{{ asset('images/logo-icon.svg') }}"
                         alt="Victoria Tour"
                         class="w-12 h-12 mx-auto mb-6 drop-shadow opacity-80"
                         onerror="this.style.display='none'">
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                        @if(isset($tour) && $tour)
                            {{ __('messages.contact_page.form_title_tour') }}
                        @else
                            {{ __('messages.contact_page.form_title') }}
                        @endif
                    </h2>
                    <p class="text-gray-600 max-w-xl mx-auto text-lg">
                        {{ __('messages.contact_page.form_subtitle') }}
                    </p>
                </div>

                {{-- Form Card --}}
                <div class="contact-form-card" data-aos="fade-up" data-aos-delay="100">
                    @if(isset($tour) && $tour)
                        <livewire:contact-form :tourId="$tour->id" :tourName="$tour->title" />
                    @else
                        <livewire:contact-form />
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         MAP SECTION
         ============================================ --}}
    <section id="section-map" class="contact-map-section relative">
        {{-- Map Container --}}
        <div class="relative h-[500px] md:h-[550px]">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4!2d106.7!3d10.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ4JzAwLjAiTiAxMDbCsDQyJzAwLjAiRQ!5e0!3m2!1sen!2s!4v1600000000000!5m2!1sen!2s"
                class="w-full h-full grayscale-[30%] contrast-[1.1]"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </div>

        {{-- Floating Quick Contact Card --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 w-full max-w-lg px-4 z-10" data-aos="fade-up">
            <div class="map-floating-card">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-accent-500 to-accent-400 flex items-center justify-center flex-shrink-0 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-heading font-bold text-gray-900 text-lg">{{ __('messages.contact_page.our_location') }}</h4>
                        <p class="text-sm text-gray-600 truncate">{{ App\Models\Setting::get('address', 'Ho Chi Minh City, Vietnam') }}</p>
                    </div>
                    <a href="https://maps.google.com/?q={{ urlencode(App\Models\Setting::get('address', 'Ho Chi Minh City, Vietnam')) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="flex-shrink-0 px-5 py-3 bg-gradient-to-r from-accent-500 to-accent-400 text-white text-sm font-semibold rounded-full hover:shadow-lg hover:shadow-accent-500/30 transition-all duration-300 hover:-translate-y-0.5">
                        {{ __('messages.contact_page.get_directions') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
