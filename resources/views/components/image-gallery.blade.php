@props([
    'featured' => null,
    'images' => [],
    'title' => 'Gallery',
    'fallback' => null
])

@php
    // Build all gallery images array
    $allImages = [];

    // Add featured image first
    if ($featured) {
        $allImages[] = $featured;
    }

    // Add gallery images
    foreach ($images as $image) {
        if (is_string($image)) {
            $allImages[] = $image;
        } elseif (is_object($image) && method_exists($image, 'getUrl')) {
            $allImages[] = $image->getUrl();
        }
    }

    // Use fallback if no images
    if (empty($allImages) && $fallback) {
        $allImages[] = $fallback;
    }

    $hasMultipleImages = count($allImages) > 1;
@endphp

<div class="image-gallery" x-data="{ activeIndex: 0 }">
    @if(count($allImages) > 0)
        <!-- Main Image Display -->
        <div class="relative rounded-xl overflow-hidden mb-4 bg-gray-100">
            <!-- Main Swiper -->
            <div id="mainGallerySwiper" class="swiper aspect-[16/10]">
                <div class="swiper-wrapper">
                    @foreach($allImages as $index => $image)
                        <div class="swiper-slide">
                            <a href="{{ $image }}" class="glightbox block w-full h-full" data-gallery="tour-gallery" data-title="{{ $title }} - Image {{ $index + 1 }}">
                                <img src="{{ $image }}" alt="{{ $title }} - Image {{ $index + 1 }}" class="w-full h-full object-cover">
                            </a>
                        </div>
                    @endforeach
                </div>

                @if($hasMultipleImages)
                    <!-- Navigation Arrows -->
                    <button class="swiper-button-prev !w-10 !h-10 !bg-white/80 !rounded-full !text-gray-800 after:!text-sm hover:!bg-white transition shadow-lg"></button>
                    <button class="swiper-button-next !w-10 !h-10 !bg-white/80 !rounded-full !text-gray-800 after:!text-sm hover:!bg-white transition shadow-lg"></button>
                @endif

                <!-- Image Counter -->
                <div class="absolute bottom-4 right-4 bg-black/60 text-white px-3 py-1.5 rounded-full text-sm font-medium z-10">
                    <span class="current-slide">1</span> / {{ count($allImages) }}
                </div>

                <!-- Fullscreen Hint -->
                <div class="absolute top-4 right-4 bg-black/60 text-white px-3 py-1.5 rounded-full text-sm font-medium z-10 flex items-center gap-2 cursor-pointer hover:bg-black/80 transition" onclick="document.querySelector('.glightbox').click()">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                    <span class="hidden sm:inline">View Full</span>
                </div>
            </div>
        </div>

        @if($hasMultipleImages)
            <!-- Thumbnails Swiper -->
            <div id="thumbsGallerySwiper" class="swiper thumbs-gallery">
                <div class="swiper-wrapper">
                    @foreach($allImages as $index => $image)
                        <div class="swiper-slide cursor-pointer rounded-lg overflow-hidden opacity-60 hover:opacity-100 transition border-2 border-transparent">
                            <img src="{{ $image }}" alt="{{ $title }} - Thumbnail {{ $index + 1 }}" class="w-full h-full object-cover aspect-square">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <!-- No Images Fallback -->
        <div class="aspect-[16/10] bg-gray-200 rounded-xl flex items-center justify-center">
            <div class="text-gray-400 text-center">
                <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p>No images available</p>
            </div>
        </div>
    @endif
</div>

@if(count($allImages) > 0)
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize GLightbox
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: true,
        openEffect: 'zoom',
        closeEffect: 'fade',
        cssEfects: {
            fade: { in: 'fadeIn', out: 'fadeOut' },
            zoom: { in: 'zoomIn', out: 'zoomOut' }
        }
    });

    @if($hasMultipleImages)
    // Initialize Thumbs Swiper
    const thumbsSwiper = new Swiper('#thumbsGallerySwiper', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            640: { slidesPerView: 5 },
            768: { slidesPerView: 6 },
            1024: { slidesPerView: 7 }
        }
    });

    // Initialize Main Swiper
    const mainSwiper = new Swiper('#mainGallerySwiper', {
        modules: [SwiperModules.Navigation, SwiperModules.Thumbs],
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: thumbsSwiper,
        },
        on: {
            slideChange: function() {
                document.querySelector('.current-slide').textContent = this.activeIndex + 1;

                // Update thumbnail active state
                document.querySelectorAll('#thumbsGallerySwiper .swiper-slide').forEach((thumb, index) => {
                    if (index === this.activeIndex) {
                        thumb.classList.remove('opacity-60', 'border-transparent');
                        thumb.classList.add('opacity-100', 'border-accent-500');
                    } else {
                        thumb.classList.add('opacity-60', 'border-transparent');
                        thumb.classList.remove('opacity-100', 'border-accent-500');
                    }
                });
            }
        }
    });

    // Set initial active thumbnail
    document.querySelector('#thumbsGallerySwiper .swiper-slide')?.classList.remove('opacity-60', 'border-transparent');
    document.querySelector('#thumbsGallerySwiper .swiper-slide')?.classList.add('opacity-100', 'border-accent-500');
    @else
    // Single image - just navigation
    new Swiper('#mainGallerySwiper', {
        modules: [SwiperModules.Navigation],
        spaceBetween: 10,
    });
    @endif
});
</script>
@endpush

@push('styles')
<style>
    .thumbs-gallery .swiper-slide {
        width: 80px;
        height: 80px;
    }
    @media (min-width: 768px) {
        .thumbs-gallery .swiper-slide {
            width: 100px;
            height: 100px;
        }
    }
</style>
@endpush
@endif
