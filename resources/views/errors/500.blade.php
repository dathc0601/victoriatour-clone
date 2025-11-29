@extends('layouts.app')

@section('title', __('messages.server_error'))
@section('meta_description', __('messages.server_error_desc'))

@section('content')
    <section class="min-h-[70vh] flex items-center justify-center bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <!-- Illustration -->
                <div class="mb-8">
                    <svg class="w-48 h-48 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>

                <!-- Error Code -->
                <h1 class="text-8xl font-heading font-bold text-red-500 mb-4">500</h1>

                <!-- Message -->
                <h2 class="text-3xl font-heading font-semibold text-gray-900 mb-4">{{ __('messages.server_error') }}</h2>
                <p class="text-gray-600 mb-8">{{ __('messages.server_error_desc') }}</p>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        {{ __('messages.go_home') }}
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-white text-primary-500 font-medium rounded-lg hover:bg-gray-100 transition border border-primary-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ __('buttons.contact_us') }}
                    </a>
                </div>

                <!-- Support Info -->
                <div class="mt-12 p-6 bg-white rounded-xl border border-gray-200">
                    <p class="text-sm text-gray-500">
                        {{ __('messages.contact_info') }}:
                        <a href="mailto:{{ App\Models\Setting::get('email', 'info@victoriatour.com') }}" class="text-primary-500 hover:underline">
                            {{ App\Models\Setting::get('email', 'info@victoriatour.com') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
