@extends('layouts.app')

@section('title', __('messages.blog.page_title'))
@section('meta_description', __('messages.blog.meta_description'))

@section('content')
    {{-- 1. HERO SECTION --}}
    <section class="blog-hero relative h-screen flex items-center justify-center" data-hero>
        {{-- Background Image --}}
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=2000&q=80"
                 alt="{{ __('messages.blog.hero_title') }}"
                 class="w-full h-full object-cover"
                 loading="eager">
            {{-- Gradient Overlay: transparent at top, white at bottom --}}
            <div class="absolute inset-0 bg-gradient-to-t from-white via-black/40 to-black/80"></div>
        </div>

        {{-- Centered Content --}}
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-bold text-white mb-6 drop-shadow-lg">
                {{ __('messages.blog.hero_title') }}
            </h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto leading-relaxed drop-shadow">
                {{ __('messages.blog.hero_subtitle') }}
            </p>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20">
            <svg class="w-8 h-8 text-gray-600 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    {{-- 2. CATEGORY TABS --}}
    <section class="sticky top-0 z-40 bg-white pb-4">
        <div class="container mx-auto px-4 flex items-center justify-center">
            <nav class="flex items-center justify-center gap-2 md:gap-4 px-4 py-2 bg-gray-200 rounded-4xl overflow-x-auto hide-scrollbar">
                {{-- All News Tab --}}
                <a href="{{ route('blog.index') }}"
                   class="px-5 py-2.5 rounded-full text-sm md:text-base font-medium whitespace-nowrap transition-all duration-200
                          {{ !$activeCategory ? 'bg-gray-100 text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                    {{ __('messages.blog.all_news') }}
                </a>

                {{-- Category Tabs --}}
                @foreach($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}"
                       class="px-5 py-2.5 rounded-full text-sm md:text-base font-medium whitespace-nowrap transition-all duration-200
                              {{ $activeCategory === $cat->slug ? 'bg-gray-100 text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </nav>
        </div>
    </section>

    {{-- 3. FEATURED ARTICLES - Editorial Masthead --}}
    @if($featuredPosts->isNotEmpty() && !$activeCategory)
    <section class="featured-masthead">
        <div class="container mx-auto px-4">
            {{-- Hero Featured Article --}}
            @if($featuredPosts->first())
                <x-featured-hero :post="$featuredPosts->first()" />
            @endif

            {{-- Separator --}}
            <div class="featured-separator"></div>

            {{-- Secondary Featured Grid --}}
            <div class="featured-secondary-grid">
                @foreach($featuredPosts->skip(1)->take(4) as $post)
                    <x-featured-secondary-card :post="$post" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- 4. LATEST NEWS - Asymmetric Bento Grid with Infinite Scroll --}}
    <section class="py-16 md:py-20 bg-white" id="latest-news-section">
        <div class="container mx-auto px-4">
            {{-- Section Title - Minimal --}}
            <div class="mb-12">
                <span class="text-xs font-medium text-gray-400 uppercase tracking-[0.2em] block mb-2">
                    {{ __('messages.blog.latest_news') }}
                </span>
                <div class="w-12 h-0.5 bg-gray-900"></div>
            </div>

            {{-- Bento Grid --}}
            @if($posts->count())
                <div class="blog-bento-grid" id="blog-bento-grid">
                    @foreach($posts as $index => $post)
                        @php
                            // Grid layout for 10 posts per page
                            $size = match($index % 10) {
                                0 => 'large',      // First: 2×2 (4 cells)
                                3 => 'wide',       // Fourth: 2 cols (2 cells)
                                6 => 'tall',       // Seventh: 2 rows (2 cells)
                                default => 'standard',
                            };
                        @endphp
                        <x-blog-bento-card :post="$post" :size="$size" />
                    @endforeach
                </div>

                {{-- Skeleton Loading (Hidden by default) --}}
                <div class="blog-bento-grid mt-0.5 hidden" id="blog-skeleton-grid">
                    <x-blog-bento-skeleton size="large" />
                    <x-blog-bento-skeleton />
                    <x-blog-bento-skeleton />
                    <x-blog-bento-skeleton size="wide" />
                    <x-blog-bento-skeleton />
                    <x-blog-bento-skeleton />
                    <x-blog-bento-skeleton size="tall" />
                    <x-blog-bento-skeleton />
                    <x-blog-bento-skeleton />
                    <x-blog-bento-skeleton />
                </div>

                {{-- Load More Trigger --}}
                <div id="load-more-trigger" class="h-20 flex items-center justify-center mt-8"
                     data-next-page="{{ $posts->hasMorePages() ? $posts->currentPage() + 1 : '' }}"
                     data-has-more="{{ $posts->hasMorePages() ? 'true' : 'false' }}"
                     data-category="{{ $activeCategory ?? '' }}">
                    @if($posts->hasMorePages())
                        <div id="load-more-spinner" class="hidden">
                            <svg class="animate-spin h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        <p id="scroll-hint" class="text-gray-400 text-sm">Scroll to load more</p>
                    @else
                        <p class="text-gray-400 text-sm">No more articles</p>
                    @endif
                </div>
            @else
                {{-- Empty State - Minimal --}}
                <div class="text-center py-20">
                    <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">
                        {{ __('messages.blog.no_posts') }}
                    </p>
                    <p class="text-gray-500">{{ __('messages.blog.no_posts_desc') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
<style>
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('blog-bento-grid');
    const skeletonGrid = document.getElementById('blog-skeleton-grid');
    const trigger = document.getElementById('load-more-trigger');
    const spinner = document.getElementById('load-more-spinner');
    const scrollHint = document.getElementById('scroll-hint');

    if (!grid || !trigger) return;

    let isLoading = false;
    let nextPage = parseInt(trigger.dataset.nextPage) || null;
    let hasMore = trigger.dataset.hasMore === 'true';
    const category = trigger.dataset.category;

    // Intersection Observer for infinite scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && hasMore && !isLoading) {
                loadMorePosts();
            }
        });
    }, {
        rootMargin: '200px',
        threshold: 0.1
    });

    if (hasMore) {
        observer.observe(trigger);
    }

    async function loadMorePosts() {
        if (isLoading || !hasMore) return;

        isLoading = true;

        // Show skeleton loading
        if (skeletonGrid) {
            skeletonGrid.classList.remove('hidden');
        }
        if (spinner) {
            spinner.classList.remove('hidden');
        }
        if (scrollHint) {
            scrollHint.classList.add('hidden');
        }

        try {
            const url = new URL(window.location.href);
            url.searchParams.set('page', nextPage);
            if (category) {
                url.searchParams.set('category', category);
            }

            const response = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();

            // Hide skeleton with a slight delay for smooth transition
            await new Promise(resolve => setTimeout(resolve, 300));

            if (skeletonGrid) {
                skeletonGrid.classList.add('hidden');
            }

            // Append new cards with animation
            if (data.html) {
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.html;

                // Add cards one by one with staggered animation
                const newCards = tempDiv.children;
                Array.from(newCards).forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    grid.appendChild(card);

                    // Staggered animation
                    setTimeout(() => {
                        card.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 50);
                });
            }

            // Update state
            hasMore = data.hasMore;
            nextPage = data.nextPage;
            trigger.dataset.hasMore = hasMore.toString();
            trigger.dataset.nextPage = nextPage;

            if (!hasMore) {
                observer.disconnect();
                if (spinner) spinner.classList.add('hidden');
                if (scrollHint) {
                    scrollHint.textContent = 'No more articles';
                    scrollHint.classList.remove('hidden');
                }
            } else {
                if (spinner) spinner.classList.add('hidden');
                if (scrollHint) scrollHint.classList.remove('hidden');
            }

        } catch (error) {
            console.error('Error loading more posts:', error);
            if (skeletonGrid) skeletonGrid.classList.add('hidden');
            if (spinner) spinner.classList.add('hidden');
            if (scrollHint) {
                scrollHint.textContent = 'Error loading posts. Scroll to retry.';
                scrollHint.classList.remove('hidden');
            }
        } finally {
            isLoading = false;
        }
    }
});
</script>
@endpush
