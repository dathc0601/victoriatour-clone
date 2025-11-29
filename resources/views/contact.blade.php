@extends('layouts.app')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with Victoria Tour. We are here to help you plan your perfect Southeast Asia adventure.')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary-500 py-16">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ __('navigation.contact') }}</h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => __('navigation.contact')]
        ]" />
    </div>

    <!-- Contact Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6">Get in Touch</h2>
                        <p class="text-gray-600 mb-8">Our team is available to assist you with any inquiries about our tours and services.</p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-500 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
                                <p class="text-gray-600">{{ App\Models\Setting::get('address', 'Ho Chi Minh City, Vietnam') }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-500 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                                <a href="tel:{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}" class="text-gray-600 hover:text-primary-500 transition">
                                    {{ App\Models\Setting::get('phone', '+84 85 692 9229') }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-500 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <a href="mailto:{{ App\Models\Setting::get('email', 'info@victoriatour.com') }}" class="text-gray-600 hover:text-primary-500 transition">
                                    {{ App\Models\Setting::get('email', 'info@victoriatour.com') }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-500 text-white rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Working Hours</h3>
                                <p class="text-gray-600">Mon - Fri: 9:00 AM - 6:00 PM<br>Sat: 9:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-8">
                        @if(isset($tour) && $tour)
                            <div class="mb-6 p-4 bg-accent-50 border border-accent-200 rounded-lg">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 w-12 h-12 bg-accent-500 text-white rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm text-accent-600 font-medium">Tour Inquiry</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $tour->title }}</p>
                                    </div>
                                </div>
                            </div>
                            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6">Inquire About This Tour</h2>
                            <livewire:contact-form :tourId="$tour->id" :tourName="$tour->title" />
                        @else
                            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6">Send us a Message</h2>
                            <livewire:contact-form />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <section class="h-96 bg-gray-200">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4!2d106.7!3d10.8!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDQ4JzAwLjAiTiAxMDbCsDQyJzAwLjAiRQ!5e0!3m2!1sen!2s!4v1600000000000!5m2!1sen!2s"
            width="100%"
            height="100%"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </section>
@endsection
