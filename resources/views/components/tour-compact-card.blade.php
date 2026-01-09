@props(['tour'])

<a href="{{ route('tours.show', $tour->slug) }}"
   class="tour-compact-card block relative rounded-xl overflow-hidden group cursor-pointer">

    <!-- Background Image with subtle zoom on hover -->
    @if($tour->getFirstMediaUrl('featured_image'))
        <img src="{{ $tour->getFirstMediaUrl('featured_image') }}"
             alt="{{ $tour->title }}"
             loading="lazy"
             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
    @else
        <img src="https://picsum.photos/seed/tour{{ $tour->id }}/600/400"
             alt="{{ $tour->title }}"
             loading="lazy"
             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">
    @endif

    <!-- Layered gradient overlay - creates depth and warmth -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent pointer-events-none"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-amber-900/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>

    <!-- Duration Badge - Glassmorphism style -->
    @if($tour->duration_days)
        <div class="absolute top-3 right-3 px-2.5 py-1 bg-white/15 backdrop-blur-md border border-white/20 text-white text-[11px] font-semibold tracking-wide rounded-md shadow-lg">
            {{ $tour->duration_days }}{{ $tour->duration_days > 1 ? 'D' : ' Day' }}
        </div>
    @endif

    <!-- Content Container - Bottom aligned -->
    <div class="absolute inset-x-0 bottom-0 p-4 flex flex-col justify-end">
        <!-- Destination with subtle icon -->
        <div class="flex items-center gap-1.5 mb-1.5">
            <svg class="w-3 h-3 text-amber-400/90" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
            </svg>
            <span class="text-[11px] text-white/70 font-medium tracking-wide uppercase truncate">
                {{ $tour->destination->name }}
            </span>
        </div>

        <!-- Title - Clean, elegant -->
        <h3 class="text-white font-semibold text-[15px] leading-snug line-clamp-2 mb-3 group-hover:text-amber-100 transition-colors duration-300">
            {{ $tour->title }}
        </h3>

        <!-- Price & Rating Row - Refined layout -->
        <div class="flex items-center justify-between pt-2.5 border-t border-white/10">
            <!-- Price -->
            <div class="flex items-baseline gap-1">
                @if($tour->price_type === 'contact')
                    <span class="text-white/90 text-sm font-semibold">Contact</span>
                @else
                    <span class="text-[11px] text-white/50 font-medium">from</span>
                    <span class="text-white text-base font-bold tracking-tight">${{ number_format($tour->price) }}</span>
                @endif
            </div>

            <!-- Rating Badge -->
            <div class="flex items-center gap-1 px-2 py-0.5 bg-white/10 backdrop-blur-sm rounded-full">
                <svg class="w-3 h-3 text-amber-400 fill-current" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                </svg>
                <span class="text-[11px] text-white/90 font-semibold">{{ number_format($tour->rating, 1) }}</span>
            </div>
        </div>
    </div>

    <!-- Hover border glow effect -->
    <div class="absolute inset-0 rounded-xl ring-1 ring-white/10 group-hover:ring-amber-400/30 transition-all duration-500 pointer-events-none"></div>
</a>
