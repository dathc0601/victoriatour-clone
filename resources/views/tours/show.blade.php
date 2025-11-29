@extends('layouts.app')

@section('title', $tour->title)
@section('meta_description', $tour->meta_description ?? $tour->excerpt ?? Str::limit(strip_tags($tour->description), 160))
@section('canonical', route('tours.show', $tour->slug))
@section('og_title', $tour->title . ' | Victoria Tour')
@section('og_description', $tour->excerpt ?? Str::limit(strip_tags($tour->description), 160))
@section('og_type', 'product')

@php
    $featuredImage = $tour->getFirstMediaUrl('featured_image') ?: 'https://picsum.photos/seed/tour' . $tour->id . '/1920/800';
    $galleryImages = $tour->getMedia('gallery')->map(fn($media) => $media->getUrl())->toArray();
@endphp

@section('og_image', $featuredImage)

@push('json-ld')
    <x-json-ld type="tour" :data="$tour" />
@endpush

@section('content')
    <!-- Hero Header -->
    <section class="bg-primary-500 py-8 md:py-12">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <div class="mb-4 [&_nav]:py-0 [&_a]:text-gray-300 [&_a:hover]:text-white [&_span]:text-white [&_svg]:text-gray-400">
                <x-breadcrumbs :items="[
                    ['name' => __('navigation.tours'), 'url' => route('tours.index')],
                    ['name' => $tour->title]
                ]" />
            </div>

            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($tour->categories as $category)
                    <span class="px-3 py-1 bg-accent-500 text-white text-sm font-medium rounded-full">{{ $category->name }}</span>
                @endforeach
            </div>
            <h1 class="text-3xl md:text-4xl font-heading font-bold text-white mb-4">{{ $tour->title }}</h1>

            <!-- Social Share -->
            <div class="mb-4">
                <x-social-share :url="route('tours.show', $tour->slug)" :title="$tour->title" size="sm" />
            </div>

            <div class="flex flex-wrap items-center gap-6 text-gray-200">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $tour->destination->name }}@if($tour->city), {{ $tour->city->name }}@endif
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $tour->duration_days }} {{ Str::plural('Day', $tour->duration_days) }}
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                    {{ number_format($tour->rating, 1) }}
                </span>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Image Gallery -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <x-image-gallery
                            :featured="$featuredImage"
                            :images="$galleryImages"
                            :title="$tour->title"
                            :fallback="'https://picsum.photos/seed/tour' . $tour->id . '/1920/800'"
                        />
                    </div>

                    <!-- Description -->
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6">Tour Overview</h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $tour->description !!}
                        </div>
                    </div>

                    <!-- Itinerary -->
                    @if($tour->itinerary)
                        <div class="bg-white rounded-xl shadow-md p-8">
                            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <svg class="w-8 h-8 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                Day-by-Day Itinerary
                            </h2>
                            <x-itinerary-accordion :itinerary="$tour->itinerary" :duration="$tour->duration_days" />
                        </div>
                    @endif

                    <!-- Inclusions & Exclusions -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($tour->inclusions)
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <h3 class="text-xl font-heading font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Inclusions
                                </h3>
                                <div class="prose prose-sm text-gray-600">
                                    {!! $tour->inclusions !!}
                                </div>
                            </div>
                        @endif

                        @if($tour->exclusions)
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <h3 class="text-xl font-heading font-bold text-gray-900 mb-4 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Exclusions
                                </h3>
                                <div class="prose prose-sm text-gray-600">
                                    {!! $tour->exclusions !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Booking Card -->
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                        <div class="mb-6">
                            @if($tour->price_type === 'contact')
                                <span class="text-gray-500">Contact us for pricing</span>
                            @else
                                <span class="text-sm text-gray-500">{{ $tour->price_type === 'from' ? 'Starting from' : 'Price' }}</span>
                                <div class="text-3xl font-bold text-accent-500">${{ number_format($tour->price) }}</div>
                                <span class="text-sm text-gray-500">per person</span>
                            @endif
                        </div>

                        <a href="{{ route('contact') }}?tour={{ $tour->slug }}" class="block w-full px-6 py-3 bg-accent-500 text-white text-center font-medium rounded-lg hover:bg-accent-600 transition shadow-md hover:shadow-lg mb-4">
                            Book This Tour
                        </a>

                        <a href="{{ route('contact') }}" class="block w-full px-6 py-3 border-2 border-primary-500 text-primary-500 text-center font-medium rounded-lg hover:bg-primary-500 hover:text-white transition">
                            Ask a Question
                        </a>

                        <div class="mt-6 pt-6 border-t space-y-4">
                            <div class="flex items-center gap-3 text-gray-600">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Free cancellation
                            </div>
                            <div class="flex items-center gap-3 text-gray-600">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Best price guarantee
                            </div>
                            <div class="flex items-center gap-3 text-gray-600">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                24/7 customer support
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Tours -->
    @if($relatedTours->count())
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-heading font-bold text-gray-900 mb-8">You Might Also Like</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedTours as $related)
                        <x-tour-card :tour="$related" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
