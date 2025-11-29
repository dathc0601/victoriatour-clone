@extends('layouts.app')

@section('title', $page->title)
@section('meta_description', $page->meta_description ?? Str::limit(strip_tags($page->content), 160))

@section('content')
    <!-- Page Header -->
    <section class="bg-primary-500 py-16">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ $page->title }}</h1>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => $page->title]
        ]" />
    </div>

    <!-- Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <article class="bg-white rounded-xl shadow-md p-8 md:p-12">
                    <div class="prose prose-lg max-w-none">
                        {!! $page->content !!}
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-primary-500 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-heading font-bold mb-4">Ready to Start Your Journey?</h2>
            <p class="text-gray-200 mb-8 max-w-2xl mx-auto">Contact us today and let us help you plan your perfect Southeast Asia adventure.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition shadow-lg">
                Get in Touch
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </section>
@endsection
