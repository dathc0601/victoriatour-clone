@props(['post'])

<article class="featured-secondary-card group">
    {{-- Image --}}
    <div class="featured-secondary-image">
        <a href="{{ route('blog.show', $post->slug) }}" tabindex="-1" aria-hidden="true">
            @if($post->getFirstMediaUrl('featured_image'))
                <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                     alt=""
                     width="400"
                     height="250"
                     loading="lazy">
            @else
                <img src="https://picsum.photos/seed/sec{{ $post->id }}/400/250"
                     alt=""
                     width="400"
                     height="250"
                     loading="lazy">
            @endif
        </a>
    </div>

    {{-- Content --}}
    <div class="featured-secondary-content">
        @if($post->category)
            <span class="featured-secondary-category">
                {{ $post->category->name }}
            </span>
        @endif

        <h3 class="featured-secondary-title">
            <a href="{{ route('blog.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h3>

        @if($post->published_at)
            <span class="featured-secondary-date">
                {{ $post->published_at->format('M d, Y') }}
            </span>
        @endif
    </div>
</article>
