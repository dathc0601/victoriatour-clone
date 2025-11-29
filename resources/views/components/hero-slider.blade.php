@props(['sliders'])

<section class="relative h-[70vh] min-h-[500px] max-h-[700px]">
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

                    <!-- Content -->
                    <div class="relative h-full flex items-center">
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
                    <div class="relative h-full flex items-center">
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

        <!-- Pagination -->
        <div class="swiper-pagination !bottom-8"></div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>
@endpush
