@props([
    'title',
    'content' => null,
    'image' => null,
    'imagePosition' => 'left',
    'link' => null,
    'linkText' => null,
])

<div class="info-section container mx-auto px-4">
    <div class="info-section-grid {{ $imagePosition === 'right' ? 'lg:flex-row-reverse' : '' }}">
        {{-- Image Side --}}
        @if($image)
            <div class="info-section-image {{ $imagePosition === 'right' ? 'lg:order-2' : '' }}"
                 data-aos="{{ $imagePosition === 'right' ? 'fade-left' : 'fade-right' }}">
                <img src="{{ $image }}"
                     alt="{{ $title }}"
                     loading="lazy"
                     class="w-full h-auto rounded-2xl">
            </div>
        @endif

        {{-- Content Side --}}
        <div class="info-section-content {{ $imagePosition === 'right' ? 'lg:order-1' : '' }}"
             data-aos="{{ $imagePosition === 'right' ? 'fade-right' : 'fade-left' }}">

            {{-- Title --}}
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-gray-900 mb-6">
                {{ $title }}
            </h2>

            {{-- Content --}}
            @if($content)
                <div class="prose prose-lg text-gray-600 mb-6 max-w-none">
                    {!! $content !!}
                </div>
            @endif

            {{-- Link --}}
            @if($link && $linkText)
                <a href="{{ $link }}"
                   class="inline-flex items-center gap-2 text-accent-500 hover:text-accent-600 font-medium transition-colors">
                    {{ $linkText }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
</div>
