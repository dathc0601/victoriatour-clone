@props(['city', 'variant' => 'standard', 'position' => 1])

@if($variant === 'featured')
    {{-- Featured Card: Blurred Background with Text Content --}}
    <a href="{{ route('destinations.city', ['destination' => $city->destination->slug, 'city' => $city->slug]) }}"
       class="destination-card group block h-full"
       data-aos="fade-up"
       data-aos-delay="{{ $position * 50 }}">

        {{-- Image Container --}}
        <div class="absolute inset-0">
            @if($city->getFirstMediaUrl('image'))
                <img src="{{ $city->getFirstMediaUrl('image') }}"
                     alt="{{ $city->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110 blur-sm">
            @else
                <img src="https://picsum.photos/seed/city{{ $city->id }}/800/600"
                     alt="{{ $city->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110 blur-sm">
            @endif
        </div>

        <div class="absolute inset-0 bg-black/40"></div>

        {{-- Country Badge (Top Left) --}}
        @if($city->destination)
            <div class="absolute top-4 left-4 z-20 px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium rounded-full">
                {{ $city->destination->name }}
            </div>
        @endif

        {{-- Tour Count Badge (Top Right) --}}
        <div class="absolute top-4 right-4 z-20 px-3 py-1.5 bg-amber-500 text-white text-xs font-semibold rounded-full">
            {{ $city->tours_count ?? 0 }} {{ Str::plural('Tour', $city->tours_count ?? 0) }}
        </div>

        {{-- Content --}}
        <div class="relative h-full flex flex-col justify-center items-center text-center p-6 text-white z-10">
            <h3 class="text-2xl font-heading font-bold mb-3">
                {{ $city->name }}
            </h3>
            @if($city->description)
                <p class="text-sm text-gray-200 leading-relaxed mb-4 line-clamp-3 max-w-xs">
                    {{ Str::limit(strip_tags($city->description), 150) }}
                </p>
            @endif
            <span class="inline-flex items-center gap-1 text-accent-400 font-medium
                        group-hover:gap-2 transition-all duration-300">
                {{ __('messages.home.discover_more') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </span>
        </div>
    </a>

@else
    {{-- Standard/Tall/Large Card: Image with Name Overlay at bottom --}}
    <a href="{{ route('destinations.city', ['destination' => $city->destination->slug, 'city' => $city->slug]) }}"
       class="destination-card group block h-full"
       data-aos="fade-up"
       data-aos-delay="{{ $position * 50 }}">

        {{-- Image Container --}}
        <div class="absolute inset-0">
            @if($city->getFirstMediaUrl('image'))
                <img src="{{ $city->getFirstMediaUrl('image') }}"
                     alt="{{ $city->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110">
            @else
                <img src="https://picsum.photos/seed/city{{ $city->id }}/800/600"
                     alt="{{ $city->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110">
            @endif
        </div>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

        {{-- Country Badge (Top Left) --}}
        @if($city->destination)
            <div class="absolute top-4 left-4 z-20 px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium rounded-full">
                {{ $city->destination->name }}
            </div>
        @endif

        {{-- Tour Count Badge (Top Right) --}}
        <div class="absolute top-4 right-4 z-20 px-3 py-1.5 bg-amber-500 text-white text-xs font-semibold rounded-full">
            {{ $city->tours_count ?? 0 }} {{ Str::plural('Tour', $city->tours_count ?? 0) }}
        </div>

        {{-- City Name at Bottom --}}
        <div class="absolute inset-0 flex items-end justify-center pb-6 z-10">
            <h3 class="text-xl md:text-2xl font-heading font-bold text-white text-center px-4
                       drop-shadow-lg group-hover:text-accent-400 transition-colors duration-300">
                {{ $city->name }}
            </h3>
        </div>
    </a>
@endif
