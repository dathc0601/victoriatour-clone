@extends('layouts.app')

@section('title', 'Destinations')
@section('meta_description', 'Explore our destinations across Southeast Asia. Vietnam, Thailand, Cambodia, Laos, and more await your discovery.')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary-500 py-16">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ __('navigation.destinations') }}</h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">Discover the beauty and culture of Southeast Asia's most captivating destinations</p>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => __('navigation.destinations')]
        ]" />
    </div>

    <!-- Destinations Grid -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($destinations as $destination)
                    <x-destination-card :destination="$destination" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-500 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-heading font-bold mb-4">Can't Find What You're Looking For?</h2>
            <p class="text-gray-200 mb-8 max-w-2xl mx-auto">Let us create a custom itinerary tailored to your preferences and travel style.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition shadow-lg">
                Contact Us
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>
@endsection
