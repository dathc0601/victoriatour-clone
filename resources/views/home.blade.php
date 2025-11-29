@extends('layouts.app')

@section('title', 'Home')
@section('meta_description', 'Victoria Tour - Your trusted travel partner for unforgettable journeys across Southeast Asia. Discover Vietnam, Thailand, Cambodia, and more.')

@section('content')
    <!-- Hero Slider -->
    <x-hero-slider :sliders="$sliders" />

    <!-- Differentiators Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <x-section-title
                title="Why Choose Us"
                subtitle="We bring you the best travel experiences with our dedicated services"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                @foreach($differentiators as $item)
                    <x-differentiator-card :differentiator="$item" />
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <x-section-title
                title="Popular Destinations"
                subtitle="Explore our most sought-after destinations across Southeast Asia"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                @foreach($featuredDestinations as $destination)
                    <x-destination-card :destination="$destination" />
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition shadow-md hover:shadow-lg">
                    View All Destinations
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Tours -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <x-section-title
                title="Featured Tours"
                subtitle="Handpicked tours designed to give you extraordinary travel experiences"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
                @foreach($featuredTours as $tour)
                    <x-tour-card :tour="$tour" />
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition shadow-md hover:shadow-lg">
                    Explore All Tours
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
                    <span class="inline-block px-4 py-2 bg-accent-500 text-white text-sm font-medium rounded-full mb-6">About Victoria Tour</span>
                    <h2 class="text-3xl md:text-4xl font-heading font-bold mb-6">Your Trusted Travel Partner Since 2010</h2>
                    <p class="text-gray-200 text-lg mb-6 leading-relaxed">
                        Victoria Tour has been creating unforgettable travel experiences across Southeast Asia for over a decade. We specialize in tailor-made journeys that combine cultural immersion, natural beauty, and local authenticity.
                    </p>
                    <p class="text-gray-200 mb-8 leading-relaxed">
                        Our team of experienced travel consultants works tirelessly to ensure every trip exceeds your expectations. From luxury escapes to adventure tours, we cater to all types of travelers.
                    </p>
                    <a href="{{ url('/about-us') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-primary-500 font-medium rounded-lg hover:bg-gray-100 transition">
                        Learn More About Us
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div data-aos="fade-left" class="relative">
                    <img src="https://picsum.photos/seed/about/600/400" alt="Victoria Tour Team" class="rounded-2xl shadow-2xl w-full">
                    <div class="absolute -bottom-6 -left-6 bg-accent-500 text-white p-6 rounded-xl shadow-lg">
                        <div class="text-4xl font-bold">15+</div>
                        <div class="text-sm">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blog Posts -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <x-section-title
                title="Travel Inspiration"
                subtitle="Tips, stories, and guides from our travel experts"
            />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-12">
                @foreach($latestPosts as $post)
                    <x-blog-card :post="$post" />
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border-2 border-primary-500 text-primary-500 font-medium rounded-lg hover:bg-primary-500 hover:text-white transition">
                    Read More Articles
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="py-20 bg-gradient-to-r from-primary-500 to-primary-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-heading font-bold mb-4">Get Travel Deals & Inspiration</h2>
                <p class="text-gray-200 mb-8 text-lg">Subscribe to our newsletter and be the first to know about exclusive offers and travel tips.</p>
                <div class="max-w-md mx-auto">
                    <livewire:newsletter-form />
                </div>
            </div>
        </div>
    </section>
@endsection
