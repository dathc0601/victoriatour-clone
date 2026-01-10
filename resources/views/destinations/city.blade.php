@extends('layouts.app')

@section('title', $city->name . ' - ' . $destination->name)
@section('meta_description', Str::limit(strip_tags($city->description), 160) ?: __('messages.city.meta_description', ['city' => $city->name, 'destination' => $destination->name]))

@section('content')
    {{-- Hero Section --}}
    <section class="city-hero relative h-[60vh] min-h-[400px] flex items-center justify-center" data-hero>
        {{-- Background Image --}}
        <div class="absolute inset-0">
            @if($city->getFirstMediaUrl('image'))
                <img src="{{ $city->getFirstMediaUrl('image') }}"
                     alt="{{ $city->name }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @else
                <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=2000&q=80"
                     alt="{{ $city->name }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/20"></div>
        </div>

        {{-- Content --}}
        <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
            {{-- Country Badge --}}
            <a href="{{ route('destinations.show', $destination->slug) }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium mb-6 hover:bg-white/30 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $destination->name }}
            </a>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-4">
                {{ $city->name }}
            </h1>

            @if($city->description)
                <p class="text-lg text-gray-200 max-w-2xl mx-auto leading-relaxed">
                    {{ Str::limit(strip_tags($city->description), 200) }}
                </p>
            @endif

            {{-- Tours Count --}}
            <div class="mt-6">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-full font-medium">
                    {{ $tours->total() }} {{ Str::plural(__('messages.tour'), $tours->total()) }}
                </span>
            </div>
        </div>
    </section>

    {{-- Breadcrumb --}}
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="container mx-auto px-4 py-4">
            <nav class="flex items-center gap-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-primary-600 transition-colors">
                    {{ __('navigation.home') }}
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('destinations.index') }}" class="hover:text-primary-600 transition-colors">
                    {{ __('navigation.destinations') }}
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('destinations.show', $destination->slug) }}" class="hover:text-primary-600 transition-colors">
                    {{ $destination->name }}
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900 font-medium">{{ $city->name }}</span>
            </nav>
        </div>
    </div>

    {{-- Tours Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            {{-- Section Title --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4">
                    {{ __('messages.city.tours_title', ['city' => $city->name]) }}
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    {{ __('messages.city.tours_subtitle', ['city' => $city->name, 'destination' => $destination->name]) }}
                </p>
            </div>

            @if($tours->count())
                {{-- Tours Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($tours as $tour)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <x-tour-card :tour="$tour" />
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $tours->links() }}
                </div>
            @else
                {{-- No Tours Message --}}
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        {{ __('messages.city.no_tours_title') }}
                    </h3>
                    <p class="text-gray-600 mb-6">
                        {{ __('messages.city.no_tours_message', ['city' => $city->name]) }}
                    </p>
                    <a href="{{ route('destinations.show', $destination->slug) }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        {{ __('messages.city.back_to_destination', ['destination' => $destination->name]) }}
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- Back to Destination CTA --}}
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-600 mb-4">
                {{ __('messages.city.explore_more', ['destination' => $destination->name]) }}
            </p>
            <a href="{{ route('destinations.show', $destination->slug) }}"
               class="inline-flex items-center gap-2 px-6 py-3 border-2 border-primary-500 text-primary-500 font-medium rounded-lg hover:bg-primary-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                {{ __('messages.city.view_all_in_destination', ['destination' => $destination->name]) }}
            </a>
        </div>
    </section>
@endsection
