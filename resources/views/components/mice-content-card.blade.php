@props(['content', 'index' => 0])

<article class="mice-content-card group"
         data-aos="fade-up"
         data-aos-delay="{{ $index * 50 }}">
    {{-- Image Container --}}
    <div class="mice-card-image">
        @if($content->getFirstMediaUrl('featured_image'))
            <img src="{{ $content->getFirstMediaUrl('featured_image') }}"
                 alt="{{ $content->title }}"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                 loading="lazy">
        @else
            <div class="w-full h-full bg-gradient-to-br from-gray-200 via-gray-100 to-gray-200 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
        @endif

        {{-- Overlay Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

        {{-- Country Badge --}}
        <div class="absolute top-4 left-4 z-10">
            <span class="mice-card-badge mice-card-badge-country">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                {{ $content->destination->name }}
            </span>
        </div>

        {{-- Delegates Badge --}}
        @if($content->min_delegates)
            <div class="absolute top-4 right-4 z-10">
                <span class="mice-card-badge mice-card-badge-delegates">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    {{ $content->min_delegates }}{{ $content->max_delegates ? '-'.$content->max_delegates : '+' }}
                </span>
            </div>
        @endif

        {{-- Featured Badge --}}
        @if($content->is_featured)
            <div class="absolute bottom-4 left-4 z-10">
                <span class="mice-card-badge mice-card-badge-featured">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    {{ __('messages.mice.featured') }}
                </span>
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="mice-card-content">
        {{-- Region Tag --}}
        @if($content->region)
            <span class="mice-card-region">{{ $content->region }}</span>
        @endif

        {{-- Title --}}
        <h3 class="mice-card-title">
            {{ $content->title }}
        </h3>

        {{-- Subtitle --}}
        @if($content->subtitle)
            <p class="mice-card-subtitle">{{ Str::limit($content->subtitle, 80) }}</p>
        @endif

        {{-- Features Tags --}}
        @if($content->venue_features && count($content->venue_features))
            <div class="mice-card-features">
                @foreach(array_slice($content->venue_features, 0, 3) as $feature)
                    <span class="mice-card-feature-tag">{{ $feature }}</span>
                @endforeach
                @if(count($content->venue_features) > 3)
                    <span class="mice-card-feature-tag mice-card-feature-more">+{{ count($content->venue_features) - 3 }}</span>
                @endif
            </div>
        @endif

        {{-- Divider --}}
        <div class="mice-card-divider"></div>

        {{-- Footer --}}
        <div class="mice-card-footer">
            {{-- Services Preview --}}
            @if($content->services_included && count($content->services_included))
                <div class="mice-card-services">
                    @foreach(array_slice($content->services_included, 0, 2) as $service)
                        <span class="flex items-center gap-1 text-xs text-gray-500">
                            <svg class="w-3 h-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            {{ $service }}
                        </span>
                    @endforeach
                </div>
            @endif

            {{-- CTA Link --}}
            <a href="{{ route('contact') }}?inquiry=mice&content={{ $content->id }}"
               class="mice-card-cta">
                {{ __('messages.mice.learn_more') }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</article>
