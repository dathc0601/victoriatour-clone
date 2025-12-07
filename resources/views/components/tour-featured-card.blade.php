@props(['tour', 'size' => 'large'])

<article class="group relative h-full min-h-[500px] rounded-2xl overflow-hidden shadow-lg">
    {{-- Background Image --}}
    <a href="{{ route('tours.show', $tour->slug) }}" class="absolute inset-0">
        @if($tour->getFirstMediaUrl('featured_image'))
            <img src="{{ $tour->getFirstMediaUrl('featured_image') }}"
                 alt="{{ $tour->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <img src="https://picsum.photos/seed/tour{{ $tour->id }}/800/600"
                 alt="{{ $tour->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @endif
    </a>

    {{-- Gradient Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

    {{-- Featured Badge --}}
    <div class="absolute top-4 left-4 px-3 py-1.5 bg-amber-500 text-white text-xs font-semibold rounded-full">
        {{ __('messages.featured') }}
    </div>

    {{-- Duration Badge --}}
    @if($tour->duration_days)
        <div class="absolute top-4 right-4 px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium rounded-full">
            {{ $tour->duration_days }} {{ Str::plural('Day', $tour->duration_days) }}
        </div>
    @endif

    {{-- Content at Bottom --}}
    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
        {{-- Meta Row --}}
        <div class="flex items-center gap-4 mb-3">
            <span class="text-sm text-gray-300">{{ $tour->destination->name }}</span>
            @if($tour->categories->count())
                <span class="text-amber-400 text-sm font-medium">
                    {{ $tour->categories->first()->name }}
                </span>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="text-2xl md:text-3xl font-heading font-bold mb-3 line-clamp-2 group-hover:text-amber-400 transition">
            <a href="{{ route('tours.show', $tour->slug) }}">{{ $tour->title }}</a>
        </h3>

        {{-- Price & Rating --}}
        <div class="flex items-center justify-between">
            <span class="text-xl font-semibold">
                @if($tour->price_type === 'contact')
                    {{ __('messages.contact_for_price') }}
                @else
                    {{ __('messages.from') }} ${{ number_format($tour->price) }}
                @endif
            </span>
            <div class="flex items-center gap-1">
                <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                </svg>
                <span class="text-sm">{{ number_format($tour->rating, 1) }}</span>
            </div>
        </div>
    </div>
</article>
