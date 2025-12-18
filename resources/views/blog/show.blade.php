@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', $post->meta_description ?? $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@section('content')
    {{-- ============================================
         HERO SECTION - Full Viewport
         ============================================ --}}
    <section class="blog-hero relative h-screen flex items-center justify-center" data-hero>
        {{-- Background Image --}}
        <div class="absolute inset-0">
            @if($post->getFirstMediaUrl('featured_image'))
                <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @else
                <img src="https://picsum.photos/seed/blog{{ $post->id }}/1920/1080"
                     alt="{{ $post->title }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @endif
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/20"></div>
        </div>

        {{-- Hero Content --}}
        <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
            {{-- Category Badge --}}
            @if($post->category)
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                   class="inline-block px-5 py-1.5 bg-amber-500 text-white text-sm font-medium rounded-full mb-6 hover:bg-amber-600 transition-colors">
                    {{ $post->category->name }}
                </a>
            @endif

            {{-- Title --}}
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold leading-tight mb-6">
                {{ $post->title }}
            </h1>

            {{-- Excerpt Preview --}}
            @if($post->excerpt)
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    {{ Str::limit($post->excerpt, 150) }}
                </p>
            @endif
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-center">
            <span class="text-white/60 text-sm block mb-2">{{ __('messages.blog_detail.scroll_to_read') }}</span>
            <svg class="w-6 h-6 text-white/60 mx-auto animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    {{-- ============================================
         TRANSLATION PENDING NOTICE
         ============================================ --}}
    <x-translation-pending :model="$post" class="container mx-auto px-4 pt-8" />

    {{-- ============================================
         AUTHOR SECTION
         ============================================ --}}
    <section class="py-8 bg-white border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto flex flex-col sm:flex-row items-center justify-center gap-4">
                {{-- Author Avatar --}}
                <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>

                {{-- Author Info --}}
                <div class="flex flex-wrap items-center justify-center gap-x-3 gap-y-1 text-sm text-gray-500">
                    @if($post->author)
                        <span class="font-medium text-gray-900">{{ $post->author }}</span>
                        <span class="text-gray-300 hidden sm:inline">|</span>
                    @endif

                    @if($post->published_at)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $post->published_at->format('F d, Y') }}
                        </span>
                        <span class="text-gray-300 hidden sm:inline">|</span>
                    @endif

                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $readingTime }} {{ __('messages.blog_detail.min_read') }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         ARTICLE CONTENT
         ============================================ --}}
    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <article class="max-w-3xl mx-auto blog-article-content">
                {!! $post->content !!}
            </article>
        </div>
    </section>

    {{-- ============================================
         SHARE SECTION
         ============================================ --}}
    <section class="py-10 bg-gray-50 border-t border-gray-100" x-data="{ copied: false }">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <p class="text-gray-500 text-sm mb-6">{{ __('messages.blog_detail.share_article') }}</p>

                <div class="flex items-center justify-center gap-3">
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="blog-share-btn"
                       title="Share on Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                        </svg>
                    </a>

                    {{-- X (Twitter) --}}
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="blog-share-btn"
                       title="Share on X">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>

                    {{-- LinkedIn --}}
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="blog-share-btn"
                       title="Share on LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>

                    {{-- Copy Link --}}
                    <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                            class="blog-share-btn relative"
                            title="{{ __('messages.blog_detail.copy_link') }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>

                        {{-- Copied Toast --}}
                        <span x-show="copied"
                              x-transition:enter="transition ease-out duration-200"
                              x-transition:enter-start="opacity-0 -translate-y-1"
                              x-transition:enter-end="opacity-100 translate-y-0"
                              x-transition:leave="transition ease-in duration-150"
                              x-transition:leave-start="opacity-100"
                              x-transition:leave-end="opacity-0"
                              class="absolute -top-10 left-1/2 -translate-x-1/2 text-xs bg-gray-900 text-white px-3 py-1.5 rounded whitespace-nowrap">
                            {{ __('messages.blog_detail.link_copied') }}
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================
         RELATED ARTICLES - Editorial Style
         Clean, typography-focused, no shadows
         ============================================ --}}
    @if($relatedPosts->count())
        <section class="py-16 md:py-20 bg-white border-t border-gray-100">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    {{-- Section Title - Minimal, left-aligned --}}
                    <h2 class="text-xs font-medium text-gray-400 uppercase tracking-[0.2em] mb-8">
                        {{ __('messages.blog_detail.related_articles') }}
                    </h2>

                    {{-- Articles List --}}
                    <div class="divide-y divide-gray-100">
                        @foreach($relatedPosts as $index => $related)
                            <article class="group py-6 {{ $index === 0 ? 'pt-0' : '' }} {{ $loop->last ? 'pb-0' : '' }}">
                                <a href="{{ route('blog.show', $related->slug) }}"
                                   class="flex gap-5 items-start">
                                    {{-- Thumbnail - Small, no radius --}}
                                    <div class="flex-shrink-0 w-20 md:w-28">
                                        <div class="aspect-[4/3] overflow-hidden bg-gray-100">
                                            @if($related->getFirstMediaUrl('featured_image'))
                                                <img src="{{ $related->getFirstMediaUrl('featured_image') }}"
                                                     alt="{{ $related->title }}"
                                                     loading="lazy"
                                                     class="w-full h-full object-cover
                                                            group-hover:opacity-75 transition-opacity duration-300">
                                            @else
                                                <img src="https://picsum.photos/seed/blog{{ $related->id }}/400/300"
                                                     alt="{{ $related->title }}"
                                                     loading="lazy"
                                                     class="w-full h-full object-cover
                                                            group-hover:opacity-75 transition-opacity duration-300">
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex-1 min-w-0 pt-0.5">
                                        {{-- Meta Row --}}
                                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                                            @if($related->category)
                                                <span class="uppercase tracking-wide font-medium">
                                                    {{ $related->category->name }}
                                                </span>
                                                <span class="text-gray-300">—</span>
                                            @endif
                                            @if($related->published_at)
                                                <time datetime="{{ $related->published_at->toISOString() }}">
                                                    {{ $related->published_at->format('M d, Y') }}
                                                </time>
                                            @endif
                                        </div>

                                        {{-- Title --}}
                                        <h3 class="font-heading text-base md:text-lg font-semibold text-gray-900
                                                   leading-snug line-clamp-2
                                                   group-hover:text-gray-500 transition-colors duration-200">
                                            {{ $related->title }}
                                        </h3>
                                    </div>

                                    {{-- Arrow indicator on hover --}}
                                    <div class="hidden md:flex items-center self-center
                                                opacity-0 group-hover:opacity-100
                                                -translate-x-2 group-hover:translate-x-0
                                                transition-all duration-200">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>

                    {{-- View All Link - Simple text link --}}
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <a href="{{ route('blog.index') }}"
                           class="group/link inline-flex items-center gap-2 text-sm font-medium
                                  text-gray-900 hover:text-gray-500 transition-colors duration-200">
                            <span>{{ __('messages.blog_detail.view_all_articles') }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover/link:translate-x-1"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
