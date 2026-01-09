@extends('layouts.app')

@section('title', __('messages.mice.page_title'))
@section('meta_description', __('messages.mice.meta_description'))

@section('content')
    {{-- ============================================
         HERO SECTION - Full Viewport Conference Hall
         ============================================ --}}
    <section class="mice-hero relative h-screen flex items-center justify-center overflow-hidden" data-hero data-mice-hero>
        {{-- Background Image with Parallax Effect --}}
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=2000&q=80"
                 alt="{{ __('messages.mice.hero_title') }}"
                 class="w-full h-full object-cover scale-105"
                 loading="eager">
            {{-- Multi-layer Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-primary-900/30 to-transparent"></div>
        </div>

        {{-- Decorative Elements --}}
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-black/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full h-48 bg-gradient-to-t from-white via-white/80 to-transparent"></div>

        {{-- Centered Content --}}
        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-8 border border-white/20"
                 data-aos="fade-down" data-aos-delay="100">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                <span class="text-sm font-medium text-white/90 tracking-wider uppercase">{{ __('messages.mice.badge') }}</span>
            </div>

            {{-- Main Title --}}
            <h1 class="mice-hero-title text-5xl md:text-6xl lg:text-8xl font-heading font-bold text-white mb-6 tracking-tight"
                data-aos="fade-up" data-aos-delay="200">
                {{ __('messages.mice.hero_title') }}
            </h1>

            {{-- Subtitle --}}
            <p class="text-lg md:text-xl lg:text-2xl text-white/80 max-w-3xl mx-auto leading-relaxed font-light"
               data-aos="fade-up" data-aos-delay="300">
                {{ __('messages.mice.hero_subtitle') }}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10"
                 data-aos="fade-up" data-aos-delay="400">
                <a href="#mice-content"
                   class="group inline-flex items-center gap-3 px-8 py-4 bg-amber-500 hover:bg-amber-400 text-white font-semibold rounded-full transition-all duration-300 shadow-lg shadow-amber-500/30 hover:shadow-amber-400/40 hover:-translate-y-1">
                    {{ __('messages.mice.explore_venues') }}
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-medium rounded-full backdrop-blur-sm border border-white/20 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ __('messages.mice.contact_team') }}
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-24 left-1/2 -translate-x-1/2 z-20" data-aos="fade-up" data-aos-delay="600">
            <div class="mice-scroll-indicator flex flex-col items-center gap-3">
                <span class="text-xs font-medium text-gray/70 uppercase tracking-widest">{{ __('messages.mice.scroll') }}</span>
                <div class="w-6 h-10 rounded-full border-2 border-gray/70 flex items-start justify-center p-1.5">
                    <div class="w-1.5 h-3 bg-amber-500 rounded-full animate-bounce"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         INTRO SECTION - About MICE Services
         ============================================ --}}
    <section class="pt-20 pb-4 md:pt-28 bg-white relative overflow-hidden">
        {{-- Decorative Background --}}
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-5">
            <svg viewBox="0 0 200 200" class="w-full h-full">
                <defs>
                    <pattern id="mice-pattern" width="30" height="30" patternUnits="userSpaceOnUse">
                        <rect width="2" height="2" fill="currentColor" class="text-primary-900"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#mice-pattern)"/>
            </svg>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                {{-- Logo Icon --}}
                <div class="mb-8" data-aos="fade-up">
                    <img src="{{ asset('images/logo-icon.svg') }}"
                         alt="Victoria Tour"
                         class="w-14 h-14 mx-auto drop-shadow opacity-80"
                         onerror="this.style.display='none'">
                </div>

                {{-- Section Title --}}
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-6"
                    data-aos="fade-up" data-aos-delay="100">
                    {{ __('messages.mice.intro_title') }}
                </h2>

                {{-- Description --}}
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed mb-8"
                   data-aos="fade-up" data-aos-delay="200">
                    {{ __('messages.mice.intro_desc_1') }}
                </p>
                <p class="text-lg text-gray-500 leading-relaxed"
                   data-aos="fade-up" data-aos-delay="300">
                    {{ __('messages.mice.intro_desc_2') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ============================================
         FILTER + TABS + CONTENT (Livewire Component)
         ============================================ --}}
    <div id="mice-content">
        <!-- Decorative Backgrounds -->
        <img src="{{ asset('images/bg-different-right.svg') }}"
             alt=""
             class="absolute top-0 right-0 w-auto pointer-events-none"
             aria-hidden="true">

        <livewire:mice-filter />
    </div>

    {{-- ============================================
         CTA SECTION - Contact
         ============================================ --}}
    <section class="mice-cta-section py-24 md:py-32 relative overflow-hidden">
        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-primary-800 via-primary-900 to-gray-900"></div>

        {{-- Decorative Elements --}}
        <div class="absolute top-0 left-0 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                {{-- Icon --}}
                <div class="w-20 h-20 mx-auto mb-8 rounded-2xl bg-white/10 backdrop-blur-sm flex items-center justify-center border border-white/20"
                     data-aos="fade-up">
                    <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>

                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-white mb-6"
                    data-aos="fade-up" data-aos-delay="100">
                    {{ __('messages.mice.cta_title') }}
                </h2>

                <p class="text-xl text-white/70 mb-10 max-w-2xl mx-auto"
                   data-aos="fade-up" data-aos-delay="200">
                    {{ __('messages.mice.cta_subtitle') }}
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
                     data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('contact') }}"
                       class="group inline-flex items-center gap-3 px-10 py-5 bg-amber-500 hover:bg-amber-400 text-white text-lg font-semibold rounded-full transition-all duration-300 shadow-xl shadow-amber-500/30 hover:shadow-amber-400/40 hover:-translate-y-1">
                        {{ __('messages.mice.contact_us') }}
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>

                    <a href="tel: {{ App\Models\Setting::get('contact_phone', '+84 85 692 9229') }}"
                       class="inline-flex items-center gap-3 px-8 py-4 text-white/90 hover:text-white font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        {{ App\Models\Setting::get('contact_phone', '+84 85 692 9229') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
