@props(['tour'])

<article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300 group h-full">
    {{-- Image --}}
    <a href="{{ route('tours.show', $tour->slug) }}" class="block aspect-[4/3] overflow-hidden relative">
        @if($tour->getFirstMediaUrl('featured_image'))
            <img src="{{ $tour->getFirstMediaUrl('featured_image') }}"
                 alt="{{ $tour->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <img src="https://picsum.photos/seed/tour{{ $tour->id }}/600/450"
                 alt="{{ $tour->title }}"
                 loading="lazy"
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @endif

        {{-- Duration Badge --}}
        @if($tour->duration_days)
            <div class="absolute top-3 right-3 px-2 py-1 bg-black/50 backdrop-blur-sm text-white text-xs font-medium rounded">
                {{ $tour->duration_days }}D
            </div>
        @endif
    </a>

    {{-- Content --}}
    <div class="p-4">
        {{-- Meta Row --}}
        <div class="flex items-center gap-3 text-sm mb-2">
            <span class="text-gray-500">{{ $tour->destination->name }}</span>
            @if($tour->categories->count())
                <span class="text-amber-600 font-medium">
                    {{ $tour->categories->first()->name }}
                </span>
            @endif
        </div>

        {{-- Title --}}
        <h3 class="font-heading font-semibold text-gray-900 line-clamp-2 group-hover:text-primary-600 transition mb-2">
            <a href="{{ route('tours.show', $tour->slug) }}">{{ $tour->title }}</a>
        </h3>

        {{-- Price & Rating --}}
        <div class="flex items-center justify-between">
            <span class="text-primary-600 font-bold">
                @if($tour->price_type === 'contact')
                    {{ __('messages.contact') }}
                @else
                    ${{ number_format($tour->price) }}
                @endif
            </span>
            <div class="flex items-center gap-1 text-sm text-gray-500">
                <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                </svg>
                {{ number_format($tour->rating, 1) }}
            </div>
        </div>
    </div>
</article>
