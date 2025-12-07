@props(['post'])

<article class="featured-hero group">
    {{-- Content (Left Side) --}}
    <div class="featured-hero-content">
        {{-- Category with line --}}
        @if($post->category)
            <span class="featured-hero-category">
                {{ $post->category->name }}
            </span>
        @endif

        {{-- Large Title --}}
        <h2 class="featured-hero-title">
            <a href="{{ route('blog.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h2>

        {{-- Excerpt --}}
        @if($post->excerpt)
            <p class="featured-hero-excerpt">
                {{ Str::limit($post->excerpt, 180) }}
            </p>
        @endif

        {{-- Meta Row --}}
        <div class="featured-hero-meta">
            <a href="{{ route('blog.show', $post->slug) }}" class="featured-hero-link">
                {{ __('messages.blog.read_article') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            @if($post->published_at)
                <span class="featured-hero-date">
                    {{ $post->published_at->format('M d, Y') }}
                </span>
            @endif
        </div>
    </div>

    {{-- Image (Right Side) --}}
    <div class="featured-hero-image">
        <a href="{{ route('blog.show', $post->slug) }}" tabindex="-1" aria-hidden="true">
            @if($post->getFirstMediaUrl('featured_image'))
                <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                     alt=""
                     width="800"
                     height="533"
                     loading="eager">
            @else
                <img src="https://picsum.photos/seed/featured{{ $post->id }}/800/533"
                     alt=""
                     width="800"
                     height="533"
                     loading="eager">
            @endif
        </a>
    </div>
</article>
