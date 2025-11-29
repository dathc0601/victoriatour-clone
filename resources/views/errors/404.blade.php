@extends('layouts.app')

@section('title', __('messages.page_not_found'))
@section('meta_description', __('messages.page_not_found_desc'))

@section('content')
    <section class="min-h-[70vh] flex items-center justify-center bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <!-- Illustration -->
                <div class="mb-8">
                    <svg class="w-48 h-48 mx-auto text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <!-- Error Code -->
                <h1 class="text-8xl font-heading font-bold text-primary-500 mb-4">404</h1>

                <!-- Message -->
                <h2 class="text-3xl font-heading font-semibold text-gray-900 mb-4">{{ __('messages.page_not_found') }}</h2>
                <p class="text-gray-600 mb-8">{{ __('messages.page_not_found_desc') }}</p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        {{ __('messages.go_home') }}
                    </a>
                    <a href="{{ route('tours.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary-500 font-medium rounded-lg hover:bg-gray-100 transition border border-primary-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ __('buttons.explore') }} {{ __('navigation.tours') }}
                    </a>
                </div>

                <!-- Popular Destinations -->
                <div class="mt-16">
                    <h3 class="text-lg font-heading font-semibold text-gray-900 mb-6">{{ __('navigation.destinations') }}</h3>
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach(App\Models\Destination::active()->ordered()->take(5)->get() as $destination)
                            <a href="{{ route('destinations.show', $destination->slug) }}" class="px-4 py-2 bg-white text-gray-700 rounded-full text-sm hover:bg-primary-50 hover:text-primary-500 transition border border-gray-200">
                                {{ $destination->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
