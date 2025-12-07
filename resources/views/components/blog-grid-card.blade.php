@props(['post'])

<article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 group" data-aos="fade-up">
    {{-- Image --}}
    <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-[4/3] overflow-hidden">
        @if($post->getFirstMediaUrl('featured_image'))
            <img src="{{ $post->getFirstMediaUrl('featured_image') }}"
                 alt="{{ $post->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <img src="https://picsum.photos/seed/blog{{ $post->id }}/600/450"
                 alt="{{ $post->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @endif
    </a>

    {{-- Content --}}
    <div class="p-4">
        {{-- Meta Row --}}
        <div class="flex items-center justify-between text-sm mb-2">
            @if($post->published_at)
                <span class="text-gray-500">{{ $post->published_at->format('d/m/Y') }}</span>
            @endif
            @if($post->category)
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                   class="text-red-500 font-medium hover:text-red-600 transition">
                    {{ $post->category->name }}
                </a>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="font-heading font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition">
            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
        </h3>

        {{-- Excerpt --}}
        @if($post->excerpt)
            <p class="text-gray-600 text-sm line-clamp-2">{{ $post->excerpt }}</p>
        @endif
    </div>
</article>
