@props(['sliders', 'featuredTours' => collect()])

<section class="relative h-screen" data-hero>
    <div class="swiper hero-slider h-full" id="heroSlider">
        <div class="swiper-wrapper">
            @forelse($sliders as $slider)
                <div class="swiper-slide relative">
                    <!-- Background Image -->
                    <div class="absolute inset-0">
                        @if($slider->getFirstMediaUrl('image'))
                            <img src="{{ $slider->getFirstMediaUrl('image') }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://picsum.photos/seed/slider{{ $slider->id }}/1920/1080" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
                    </div>

                    <!-- Content - Adjusted padding for tours overlay -->
                    <div class="relative h-full flex items-center {{ $featuredTours->count() ? 'pb-64 lg:pb-72' : '' }}">
                        <div class="container mx-auto px-4">
                            <div class="max-w-2xl text-white">
                                @if($slider->subtitle)
                                    <p class="text-accent-400 text-lg mb-4 font-medium" data-swiper-parallax="-100">
                                        {{ $slider->subtitle }}
                                    </p>
                                @endif
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-6 leading-tight" data-swiper-parallax="-200">
                                    {{ $slider->title }}
                                </h1>
                                @if($slider->button_text && $slider->button_url)
                                    <a href="{{ $slider->button_url }}" class="inline-flex items-center gap-2 px-8 py-4 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5" data-swiper-parallax="-300">
                                        {{ $slider->button_text }}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default slide if no sliders -->
                <div class="swiper-slide relative">
                    <div class="absolute inset-0">
                        <img src="https://picsum.photos/seed/hero/1920/1080" alt="Victoria Tour" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
                    </div>
                    <div class="relative h-full flex items-center {{ $featuredTours->count() ? 'pb-64 lg:pb-72' : '' }}">
                        <div class="container mx-auto px-4">
                            <div class="max-w-2xl text-white">
                                <p class="text-accent-400 text-lg mb-4 font-medium">Welcome to Victoria Tour</p>
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold mb-6 leading-tight">
                                    Discover Southeast Asia Your Way
                                </h1>
                                <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition shadow-lg">
                                    Explore Tours
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Navigation -->
        <div class="swiper-button-prev !text-white !w-12 !h-12 !bg-white/10 !rounded-full after:!text-lg hover:!bg-accent-500 transition"></div>
        <div class="swiper-button-next !text-white !w-12 !h-12 !bg-white/10 !rounded-full after:!text-lg hover:!bg-accent-500 transition"></div>

        <!-- Pagination - Moved up when tours overlay is present -->
        <div class="swiper-pagination {{ $featuredTours->count() ? '!bottom-64 lg:!bottom-72' : '!bottom-8' }}"></div>
    </div>

    <!-- Featured Tours Overlay -->
    @if($featuredTours->count())
        <div class="absolute bottom-0 left-0 right-0 z-20 pb-6 lg:pb-8">
            <!-- Gradient backdrop for readability -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent pointer-events-none"></div>

            <div class="relative container mx-auto px-4">
                <!-- Minimal Header Row -->
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white/90 text-xs sm:text-sm font-semibold uppercase tracking-widest">
                        {{ __('messages.home.featured_tours') }}
                    </h3>
                    <a href="{{ route('tours.index') }}" class="text-amber-400 text-xs sm:text-sm font-medium hover:text-amber-300 transition-colors flex items-center gap-1.5 group">
                        {{ __('buttons.view_all') }}
                        <svg class="w-4 h-4 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <!-- Tours Carousel -->
                <div class="relative">
                    <div class="swiper hero-tours-slider" id="heroToursSlider">
                        <div class="swiper-wrapper">
                            @foreach($featuredTours as $tour)
                                <div class="swiper-slide">
                                    <x-tour-compact-card :tour="$tour" />
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation Buttons - Glassmorphism -->
                    <button class="hero-tours-prev absolute -left-2 lg:-left-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-full flex items-center justify-center text-white hover:bg-white/20 disabled:opacity-20 disabled:cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button class="hero-tours-next absolute -right-2 lg:-right-5 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-full flex items-center justify-center text-white hover:bg-white/20 disabled:opacity-20 disabled:cursor-not-allowed">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    @endif
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Slider
        new Swiper('#heroSlider', {
            modules: [SwiperModules.Navigation, SwiperModules.Pagination, SwiperModules.Autoplay],
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            speed: 800,
            parallax: true,
            navigation: {
                nextEl: '#heroSlider .swiper-button-next',
                prevEl: '#heroSlider .swiper-button-prev',
            },
            pagination: {
                el: '#heroSlider .swiper-pagination',
                clickable: true,
            },
        });

        // Hero Tours Slider
        @if($featuredTours->count())
        new Swiper('#heroToursSlider', {
            modules: [SwiperModules.Navigation],
            slidesPerView: 1.15,
            spaceBetween: 12,
            grabCursor: true,
            navigation: {
                nextEl: '.hero-tours-next',
                prevEl: '.hero-tours-prev',
            },
            breakpoints: {
                480: { slidesPerView: 1.5, spaceBetween: 12 },
                640: { slidesPerView: 2.2, spaceBetween: 16 },
                1024: { slidesPerView: 3.5, spaceBetween: 16 },
                1280: { slidesPerView: 4.5, spaceBetween: 20 },
            }
        });
        @endif
    });
</script>
@endpush
