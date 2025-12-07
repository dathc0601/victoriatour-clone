@extends('layouts.app')

@section('title', $activeDestination
    ? __('messages.tours.page_title_destination', ['name' => $activeDestination->name])
    : __('messages.tours.page_title'))
@section('meta_description', $activeDestination
    ? ($activeDestination->meta_description ?? __('messages.tours.meta_description'))
    : __('messages.tours.meta_description'))

@section('content')
    {{-- 1. HERO SECTION (Full viewport) --}}
    <section class="tours-hero relative h-screen flex items-center justify-center" data-hero>
        {{-- Background Image --}}
        <div class="absolute inset-0">
            @if($activeDestination && $activeDestination->getFirstMediaUrl('image'))
                <img src="{{ $activeDestination->getFirstMediaUrl('image') }}"
                     alt="{{ $activeDestination->name }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @else
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=2000&q=80"
                     alt="{{ __('messages.tours.hero_title') }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @endif
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-white via-black/40 to-black/80"></div>
        </div>

        {{-- Centered Content --}}
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-bold text-white mb-6 drop-shadow-lg">
                @if($activeDestination)
                    {{ __('messages.tours.hero_title_destination', ['name' => $activeDestination->name]) }}
                @else
                    {{ __('messages.tours.hero_title') }}
                @endif
            </h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto leading-relaxed drop-shadow">
                @if($activeDestination && $activeDestination->description)
                    {{ Str::limit(strip_tags($activeDestination->description), 200) }}
                @else
                    {{ __('messages.tours.hero_subtitle') }}
                @endif
            </p>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20">
            <svg class="w-8 h-8 text-gray-600 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    {{-- 2. STICKY DESTINATION TABS --}}
    <section class="sticky top-0 z-40 bg-white pb-4">
        <div class="container mx-auto px-4 flex items-center justify-center">
            <nav class="flex items-center justify-center gap-2 md:gap-4 px-4 py-2 bg-gray-200 rounded-4xl overflow-x-auto hide-scrollbar">
                {{-- All Tours Tab --}}
                <a href="{{ route('tours.index') }}"
                   class="px-5 py-2.5 rounded-full text-sm md:text-base font-medium whitespace-nowrap transition-all duration-200
                          {{ !$activeDestination ? 'bg-gray-100 text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                    {{ __('messages.tours.all_tours') }}
                </a>

                {{-- Destination Tabs --}}
                @foreach($destinations as $dest)
                    <a href="{{ route('tours.destination', $dest->slug) }}"
                       class="px-5 py-2.5 rounded-full text-sm md:text-base font-medium whitespace-nowrap transition-all duration-200
                              {{ $activeDestination?->slug === $dest->slug ? 'bg-gray-100 text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                        {{ $dest->name }}
                    </a>
                @endforeach
            </nav>
        </div>
    </section>

    {{-- 3. FEATURED TOURS (Bento Grid) - Only show when no destination filter --}}
    @if($featuredTours->isNotEmpty() && !$activeDestination)
    <section class="py-12 md:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Large Featured Card (Left Side) --}}
                @if($featuredTours->first())
                    <div class="lg:row-span-2" data-aos="fade-right">
                        <x-tour-featured-card :tour="$featuredTours->first()" size="large" />
                    </div>
                @endif

                {{-- Smaller Cards Grid (Right Side) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($featuredTours->skip(1)->take(3) as $tour)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <x-tour-small-card :tour="$tour" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- 4. ALL TOURS SECTION with Filters --}}
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            {{-- Section Title --}}
            <div class="flex items-center gap-4 mb-10">
                <div class="w-1.5 h-10 bg-red-500 rounded-full"></div>
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900">
                    @if($activeDestination)
                        {{ __('messages.tours.all_tours_in', ['name' => $activeDestination->name]) }}
                    @else
                        {{ __('messages.tours.all_tours') }}
                    @endif
                </h2>
                <div class="flex-1 h-px bg-gray-200"></div>
            </div>

            {{-- Livewire Filter Component --}}
            <livewire:tour-filter :destination="$activeDestination?->slug" />
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush
