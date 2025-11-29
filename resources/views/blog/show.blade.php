@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
    <!-- Hero -->
    <section class="relative h-[50vh] min-h-[400px]">
        <div class="absolute inset-0">
            @if($post->getFirstMediaUrl('featured_image'))
                <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            @else
                <img src="https://picsum.photos/seed/blog{{ $post->id }}/1920/800" alt="{{ $post->title }}" class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 pb-12">
            <div class="container mx-auto px-4 text-white max-w-4xl">
                @if($post->category)
                    <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="inline-block px-4 py-1 bg-accent-500 text-white text-sm font-medium rounded-full mb-4">
                        {{ $post->category->name }}
                    </a>
                @endif
                <h1 class="text-3xl md:text-5xl font-heading font-bold mb-4">{{ $post->title }}</h1>
                <div class="flex flex-wrap items-center gap-6 text-gray-200">
                    @if($post->author)
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $post->author }}
                        </span>
                    @endif
                    @if($post->published_at)
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $post->published_at->format('F d, Y') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => __('navigation.blog'), 'url' => route('blog.index')],
            ['name' => $post->title]
        ]" />
    </div>

    <!-- Content -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <article class="bg-white rounded-xl shadow-md p-8 md:p-12">
                    <div class="prose prose-lg max-w-none">
                        {!! $post->content !!}
                    </div>
                </article>

                <!-- Share -->
                <div class="mt-8 flex items-center gap-4">
                    <span class="text-gray-600 font-medium">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}" target="_blank" class="w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center hover:bg-blue-800 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Posts -->
    @if($relatedPosts->count())
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-heading font-bold text-gray-900 mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                        <x-blog-card :post="$related" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
