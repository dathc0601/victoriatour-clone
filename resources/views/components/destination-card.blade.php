@props(['destination', 'variant' => 'standard', 'position' => 1])

@if($variant === 'explore')
    {{-- Explore Page Card: Text below card, animates into center on hover --}}
    <a href="{{ route('destinations.show', $destination->slug) }}"
       class="destination-explore-card group block"
       data-aos="fade-up"
       data-aos-delay="{{ min($position * 100, 400) }}">

        {{-- Card Wrapper - Contains both image and text area --}}
        <div class="explore-card-wrapper relative">

            {{-- Image Container - Expands on hover to cover text area --}}
            <div class="explore-card-image relative overflow-hidden rounded-2xl shadow-md
                        group-hover:shadow-xl transition-all duration-500 ease-out">

                {{-- Image --}}
                @if($destination->getFirstMediaUrl('image'))
                    <img src="{{ $destination->getFirstMediaUrl('image') }}"
                         alt="{{ $destination->name }}"
                         loading="lazy"
                         class="w-full h-full object-cover transition-all duration-500 ease-out
                                group-hover:scale-110 group-hover:blur-sm">
                @else
                    <img src="https://picsum.photos/seed/dest{{ $destination->id }}/800/600"
                         alt="{{ $destination->name }}"
                         loading="lazy"
                         class="w-full h-full object-cover transition-all duration-500 ease-out
                                group-hover:scale-110 group-hover:blur-sm">
                @endif

                {{-- Dark Overlay (appears on hover) --}}
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100
                            transition-opacity duration-500 ease-out pointer-events-none"></div>

                {{-- Display on hover --}}
                <div class="display-on-hover absolute top-[50%] left-[50%] -translate-x-[50%] translate-y-[100%]
                            group-hover:-translate-y-[50%]
                            transition-all
                            opacity-0 group-hover:opacity-100
                            ">
                    {{-- Description (turns gold on hover) --}}
                    @if($destination->description)
                        <p class="relative z-20 mt-1 text-sm text-white leading-relaxed max-w-sm mx-auto
                              transition-colors duration-500 ease-out
                              opacity-0 group-hover:opacity-100">
                            {{ Str::limit(strip_tags($destination->description), 100) }}
                        </p>
                    @endif

                    {{-- Discover More - Only visible on hover --}}
                    <span class="relative z-20 discover-more inline-flex items-center gap-2 mt-2 text-yellow-400 font-medium
                                 opacity-0 group-hover:opacity-100
                                 transition-all duration-500 delay-100 ease-out">
                        {{ __('messages.home.discover_more') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </span>
                </div>
            </div>

            {{-- Text Content - Below card normally, centered on card on hover --}}
            <div class="explore-card-text px-2 text-center transition-all duration-500 ease-out">

                {{-- Title --}}
                <h3 class="text-xl md:text-2xl font-heading font-bold
                           transition-colors duration-500 ease-out
                           text-primary-900">
                    {{ $destination->name }}
                </h3>

                {{-- Meta Title / Subtitle --}}
                @if($destination->meta_title)
                    <p class="mt-1 text-base transition-colors duration-500 ease-out
                              text-gray-600">
                        {{ $destination->meta_title }}
                    </p>
                @endif
            </div>
        </div>
    </a>

@elseif($variant === 'featured')
    {{-- Featured Card: Blurred Background with Text Content (for homepage bento) --}}
    <a href="{{ route('destinations.show', $destination->slug) }}"
       class="destination-card group block h-full"
       data-aos="fade-up"
       data-aos-delay="{{ $position * 50 }}">

        {{-- Image Container --}}
        <div class="absolute inset-0">
            @if($destination->getFirstMediaUrl('image'))
                <img src="{{ $destination->getFirstMediaUrl('image') }}"
                     alt="{{ $destination->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110 blur-sm">
            @else
                <img src="https://picsum.photos/seed/dest{{ $destination->id }}/800/600"
                     alt="{{ $destination->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110 blur-sm">
            @endif
        </div>

        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative h-full flex flex-col justify-center items-center text-center p-6 text-white z-10">
            <h3 class="text-2xl font-heading font-bold mb-3">
                {{ $destination->name }}
            </h3>
            @if($destination->description)
                <p class="text-sm text-gray-200 leading-relaxed mb-4 line-clamp-3 max-w-xs">
                    {{ Str::limit(strip_tags($destination->description), 150) }}
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
    {{-- Standard Card: Image with Name Overlay at bottom (for homepage bento) --}}
    <a href="{{ route('destinations.show', $destination->slug) }}"
       class="destination-card group block h-full"
       data-aos="fade-up"
       data-aos-delay="{{ $position * 50 }}">

        {{-- Image Container --}}
        <div class="absolute inset-0">
            @if($destination->getFirstMediaUrl('image'))
                <img src="{{ $destination->getFirstMediaUrl('image') }}"
                     alt="{{ $destination->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110">
            @else
                <img src="https://picsum.photos/seed/dest{{ $destination->id }}/800/600"
                     alt="{{ $destination->name }}"
                     loading="lazy"
                     class="w-full h-full object-cover transition-transform duration-700
                            group-hover:scale-110">
            @endif
        </div>

        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

        {{-- Name at Bottom --}}
        <div class="absolute inset-0 flex items-end justify-center pb-6 z-10">
            <h3 class="text-xl md:text-2xl font-heading font-bold text-white text-center px-4
                       drop-shadow-lg group-hover:text-accent-400 transition-colors duration-300">
                {{ $destination->name }}
            </h3>
        </div>
    </a>
@endif
