@props(['post', 'size' => 'standard'])

@php
$sizeClasses = match($size) {
    'large' => 'col-span-2 row-span-2',
    'wide' => 'col-span-2',
    'tall' => 'row-span-2',
    default => '',
};
@endphp

<article class="blog-bento-card group {{ $sizeClasses }}">
    <a href="{{ route('blog.show', $post->slug) }}" class="block h-full">
        {{-- Image Container --}}
        <div class="blog-bento-image">
            @if($post->getFirstMediaUrl('featured_image'))
                <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                     alt="{{ $post->title }}"
                     loading="lazy"
                     class="w-full h-full object-cover">
            @else
                <img src="https://picsum.photos/seed/blog{{ $post->id }}/800/600"
                     alt="{{ $post->title }}"
                     loading="lazy"
                     class="w-full h-full object-cover">
            @endif

            {{-- Hover Overlay --}}
            <div class="blog-bento-overlay"></div>
        </div>

        {{-- Content --}}
        <div class="blog-bento-content">
            {{-- Category Badge (slides in) --}}
            @if($post->category)
                <span class="blog-bento-category">
                    {{ $post->category->name }}
                </span>
            @endif

            {{-- Title with underline animation --}}
            <h3 class="blog-bento-title">
                <span>{{ $post->title }}</span>
            </h3>

            {{-- Meta Row --}}
            <div class="blog-bento-meta">
                @if($post->published_at)
                    <time datetime="{{ $post->published_at->toISOString() }}">
                        {{ $post->published_at->format('M d, Y') }}
                    </time>
                @endif
            </div>

            {{-- Arrow indicator --}}
            <div class="blog-bento-arrow">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </div>
        </div>
    </a>
</article>
