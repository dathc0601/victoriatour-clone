@props(['post'])

<article class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden group" data-aos="fade-up">
    <!-- Image -->
    <a href="{{ route('blog.show', $post->slug) }}" class="block relative aspect-[16/10] overflow-hidden">
        @if($post->getFirstMediaUrl('featured_image'))
            <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="{{ $post->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        @else
            <img src="https://picsum.photos/seed/blog{{ $post->id }}/800/500" alt="{{ $post->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        @endif
    </a>

    <!-- Content -->
    <div class="p-5">
        <!-- Meta -->
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
            @if($post->category)
                <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="text-primary-500 hover:text-primary-600 transition">
                    {{ $post->category->name }}
                </a>
            @endif
            @if($post->published_at)
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $post->published_at->format('M d, Y') }}
                </span>
            @endif
        </div>

        <!-- Title -->
        <h3 class="font-heading font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary-500 transition">
            <a href="{{ route('blog.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h3>

        <!-- Excerpt -->
        @if($post->excerpt)
            <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                {{ $post->excerpt }}
            </p>
        @endif

        <!-- Read More -->
        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-1 text-sm font-medium text-primary-500 hover:text-primary-600 transition">
            Read More
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</article>
