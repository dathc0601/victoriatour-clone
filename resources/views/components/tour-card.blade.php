@props(['tour'])

<a href="{{ route('tours.show', $tour->slug) }}"
   class="tour-card block relative rounded-2xl overflow-hidden group transition-colors"
   data-aos="fade-up">

    <!-- Full-bleed Background Image -->
    @if($tour->getFirstMediaUrl('featured_image'))
        <img src="{{ $tour->getFirstMediaUrl('featured_image') }}"
             alt="{{ $tour->title }}"
             loading="lazy"
             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
    @else
        <img src="https://picsum.photos/seed/tour{{ $tour->id }}/800/600"
             alt="{{ $tour->title }}"
             loading="lazy"
             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
    @endif

    <!-- Subtle vignette overlay for depth -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10 pointer-events-none"></div>

    <!-- Rating Badge (Top Left) -->
    <div class="absolute top-4 left-4 flex items-center gap-1 px-2.5 py-1.5 bg-white/95 backdrop-blur-sm rounded-lg shadow-sm">
        <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20">
            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
        </svg>
        <span class="text-sm font-semibold text-gray-800">{{ number_format($tour->rating, 0) }}</span>
    </div>

    <!-- Duration Badge (Top Right) - Optional -->
    @if($tour->duration_days)
        <div class="absolute top-4 right-4 px-2.5 py-1.5 bg-black/30 backdrop-blur-sm text-white text-xs font-medium rounded-lg">
            {{ $tour->duration_days }} {{ Str::plural('Day', $tour->duration_days) }}
        </div>
    @endif

    <!-- Bottom Info Bar (Dark Olive Overlay) -->
    <div class="absolute bottom-5 left-5 right-5 tour-card-info-bar px-5 py-4 rounded-lg">
        <!-- Location • Category Row -->
        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-sm mb-2.5">
            {{-- Location --}}
            <span class="flex items-center gap-1.5 text-[#c8d4a8] group-hover:text-gray-700">
                <span class="text-[#a8b888] group-hover:text-gray-700">•</span>
                {{ $tour->destination->name }}
                @if($tour->city)
                    <span class="text-[#a8b888]/70 group-hover:text-gray-700/70">/ {{ $tour->city->name }}</span>
                @endif
            </span>

            {{-- Category --}}
            @if($tour->categories->count())
                <span class="flex items-center gap-1.5 text-[#c8d4a8] group-hover:text-gray-700">
                    <span class="text-[#a8b888] group-hover:text-gray-700">•</span>
                    {{ $tour->categories->first()->name }}
                </span>
            @endif
        </div>

        <!-- Title + Price Row -->
        <div class="flex items-end justify-between gap-4">
            <h3 class="text-white group-hover:text-gray-900 font-medium text-base leading-snug line-clamp-2 flex-1 duration-300">
                {{ $tour->title }}
            </h3>
            <span class="text-white group-hover:text-gray-700 font-semibold text-base whitespace-nowrap flex-shrink-0">
                @if($tour->price_type === 'contact')
                    Contact
                @else
                    ${{ number_format($tour->price) }}
                @endif
            </span>
        </div>
    </div>
</a>
