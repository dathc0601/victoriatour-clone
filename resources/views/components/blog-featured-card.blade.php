@props(['post', 'size' => 'large'])

<article class="group relative h-full min-h-[500px] rounded-2xl overflow-hidden shadow-lg">
    {{-- Background Image --}}
    <a href="{{ route('blog.show', $post->slug) }}" class="absolute inset-0">
        @if($post->getFirstMediaUrl('featured_image'))
            <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                 alt="{{ $post->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <img src="https://picsum.photos/seed/blog{{ $post->id }}/800/600"
                 alt="{{ $post->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @endif
    </a>

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

    {{-- Content at Bottom --}}
    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
        {{-- Meta Row --}}
        <div class="flex items-center gap-4 mb-3">
            @if($post->published_at)
                <span class="text-sm text-gray-300">{{ $post->published_at->format('d/m/Y') }}</span>
            @endif
            @if($post->category)
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                   class="text-red-400 text-sm font-medium hover:text-red-300 transition">
                    {{ $post->category->name }}
                </a>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="text-2xl md:text-3xl font-heading font-bold mb-3 line-clamp-2 group-hover:text-amber-400 transition">
            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>

        {{-- Excerpt --}}
        @if($post->excerpt)
            <p class="text-gray-300 line-clamp-3 text-base">{{ $post->excerpt }}</p>
        @endif
    </div>
</article>
