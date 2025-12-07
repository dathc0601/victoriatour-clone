@extends('layouts.app')

@section('title', $destination->name)
@section('meta_description', $destination->meta_description ?? Str::limit(strip_tags($destination->description), 160))

@section('content')
    {{-- 1. HERO SECTION (Full viewport) --}}
    <section class="destination-hero relative h-screen flex items-center justify-center" data-hero>
        {{-- Background Image --}}
        <div class="absolute inset-0">
            @if($destination->getFirstMediaUrl('image'))
                <img src="{{ $destination->getFirstMediaUrl('image') }}"
                     alt="{{ $destination->name }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @else
                <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=2000&q=80"
                     alt="{{ $destination->name }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-black/20"></div>
        </div>

        {{-- Centered Content --}}
        <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-bold mb-4">
                {{ $destination->name }}
            </h1>
            @if($destination->meta_title)
                <p class="text-xl md:text-2xl text-gray-200 mb-6">{{ $destination->meta_title }}</p>
            @endif
            @if($destination->description)
                <p class="text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">
                    {{ Str::limit(strip_tags($destination->description), 250) }}
                </p>
            @endif
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 scroll-indicator z-20">
            <svg class="w-8 h-8 text-gray/70 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    {{-- 2. STICKY TAB NAVIGATION --}}
    <div x-data="stickyTabs()"
         x-init="init()"
         class="sticky-tabs-wrapper bg-white border-b border-gray-200"
         :class="{ 'is-sticky shadow-md': isSticky }">
        <div class="container mx-auto px-4">
            <nav class="flex items-center justify-center gap-2 md:gap-4 md:py-4 overflow-x-auto">
                <template x-for="tab in tabs" :key="tab.id">
                    <button
                        @click="scrollToSection(tab.id)"
                        :class="activeTab === tab.id ? 'text-primary-600 border-b-2 border-amber-500 opacity-100' : 'text-gray-600 hover:text-primary-600 opacity-60'"
                        class="flex flex-col items-center gap-2 px-4 py-2 font-medium transition-all min-w-[80px] cursor-pointer opacity-60 hover:opacity-100">
                        <span x-html="tab.icon" class="w-10 h-10"></span>
                        <span x-text="tab.label" class="text-sm whitespace-nowrap"></span>
                    </button>
                </template>
            </nav>
        </div>
    </div>

    {{-- 3. SECTION: DESTINATIONS (Cities) --}}
    @if($destination->cities->count())
    <section id="section-destination" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            {{-- Section Title --}}
            <div class="text-center mb-12">
                <img src="{{ asset('images/logo-icon.svg') }}"
                     alt="Victoria Tour"
                     class="w-12 h-12 mx-auto mb-4 drop-shadow">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                    {{ __('messages.destination.cities_title', ['name' => $destination->name]) }}
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    {{ $destination->meta_title ?? __('messages.destination.cities_subtitle') }}
                </p>
            </div>

            {{-- Swiper Carousel --}}
            <div class="relative">
                <div class="swiper cities-slider" id="citiesSlider">
                    <div class="swiper-wrapper">
                        @foreach($destination->cities as $city)
                            <div class="swiper-slide">
                                <x-city-card :city="$city" :destination="$destination" />
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <button class="cities-slider-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10
                               w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center
                               hover:bg-primary-50 transition-colors disabled:opacity-30">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="cities-slider-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10
                               w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center
                               hover:bg-primary-50 transition-colors disabled:opacity-30">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('destinations.index') }}"
                   class="inline-flex items-center gap-2 px-8 py-3 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-full transition-colors">
                    {{ __('messages.destination.view_all_destinations') }}
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- 4. SECTION: TOURS --}}
    @if($tours->count())
    <section id="section-tours" class="py-20 relative bg-white">
        <!-- Decorative Backgrounds -->
        <img src="{{ asset('images/bg-different-right.svg') }}"
             alt=""
             class="absolute top-0 right-0 w-auto pointer-events-none"
             aria-hidden="true">

        <div class="container mx-auto px-4">
            {{-- Section Title --}}
            <div class="text-center mb-12">
                <img src="{{ asset('images/logo-icon.svg') }}"
                     alt="Victoria Tour"
                     class="w-12 h-12 mx-auto mb-4 drop-shadow">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                    {{ __('messages.destination.tours_title', ['name' => $destination->name]) }}
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    {{ $destination->meta_title ?? __('messages.destination.tours_subtitle') }}
                </p>
            </div>

            {{-- Tours Swiper --}}
            <div class="relative px-4 lg:px-12">
                <div class="swiper tours-slider" id="destinationToursSlider">
                    <div class="swiper-wrapper">
                        @foreach($tours as $tour)
                            <div class="swiper-slide">
                                <x-tour-card :tour="$tour" />
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Navigation --}}
                <button class="dest-tours-prev absolute left-0 top-1/2 -translate-y-1/2 z-10
                               w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center
                               hover:bg-primary-50 transition-colors disabled:opacity-30">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button class="dest-tours-next absolute right-0 top-1/2 -translate-y-1/2 z-10
                               w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center
                               hover:bg-primary-50 transition-colors disabled:opacity-30">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                {{-- Scrollbar --}}
                <div class="dest-tours-scrollbar mt-8"></div>
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('tours.destination', $destination->slug) }}"
                   class="inline-flex items-center gap-2 px-8 py-3 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-full transition-colors">
                    {{ __('messages.destination.view_all_tours', ['name' => $destination->name]) }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- 5. SECTION: HOTELS --}}
    @if($hotels->count())
    <section id="section-hotels" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            {{-- Section Title --}}
            <div class="text-center mb-12">
                <img src="{{ asset('images/logo-icon.svg') }}"
                     alt="Victoria Tour"
                     class="w-12 h-12 mx-auto mb-4 drop-shadow">
                <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-4">
                    {{ __('messages.destination.hotels_title', ['name' => $destination->name]) }}
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    {{ $destination->meta_title ?? __('messages.destination.hotels_subtitle') }}
                </p>
            </div>

            {{-- Hotels Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($hotels as $hotel)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <x-hotel-card :hotel="$hotel" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- 6. SECTION: VISA --}}
    @if($destination->visa && $destination->visa->is_active)
    <section id="section-visa" class="py-20 bg-white">
        <x-info-section
            :title="$destination->visa->title"
            :content="$destination->visa->content"
            :image="$destination->visa->getFirstMediaUrl('image') ?: 'https://images.unsplash.com/photo-1569154941061-e231b4725ef1?auto=format&fit=crop&w=800&q=80'"
            imagePosition="left"
            :linkText="__('messages.destination.discover_more')"
        />
    </section>
    @endif

    {{-- 7. SECTION: POLICY --}}
    @if($destination->policy && $destination->policy->is_active)
    <section id="section-policy" class="py-20 bg-white">
        <x-info-section
            :title="$destination->policy->title"
            :content="$destination->policy->content"
            :image="$destination->policy->getFirstMediaUrl('image') ?: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=800&q=80'"
            imagePosition="right"
            :linkText="__('messages.destination.discover_more')"
        />
    </section>
    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cities Slider
    if (document.getElementById('citiesSlider')) {
        new Swiper('#citiesSlider', {
            modules: [SwiperModules.Navigation],
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.cities-slider-next',
                prevEl: '.cities-slider-prev',
            },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 4, spaceBetween: 24 },
                1280: { slidesPerView: 5, spaceBetween: 24 },
            }
        });
    }

    // Tours Slider
    if (document.getElementById('destinationToursSlider')) {
        new Swiper('#destinationToursSlider', {
            modules: [SwiperModules.Navigation, SwiperModules.Scrollbar],
            slidesPerView: 1,
            spaceBetween: 20,
            grabCursor: true,
            navigation: {
                nextEl: '.dest-tours-next',
                prevEl: '.dest-tours-prev',
            },
            scrollbar: {
                el: '.dest-tours-scrollbar',
                draggable: true,
            },
            breakpoints: {
                480: { slidesPerView: 1.5, spaceBetween: 16 },
                640: { slidesPerView: 2, spaceBetween: 20 },
                1024: { slidesPerView: 3, spaceBetween: 24 },
                1280: { slidesPerView: 4, spaceBetween: 24 },
            }
        });
    }
});
</script>
@endpush
