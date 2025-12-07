@props(['title', 'subtitle' => null, 'center' => true, 'icon' => null])

<div class="{{ $center ? 'text-center' : '' }} max-w-4xl {{ $center ? 'mx-auto' : '' }}" data-aos="fade-up">
    @if($icon)
        <img src="{{ asset($icon) }}" alt="" class="w-12 h-12 mx-auto mb-5 drop-shadow-sm">
    @endif
    <h2 class="text-3xl md:text-4xl lg:text-5xl font-heading {{ $icon ? 'font-normal' : 'font-bold' }} text-gray-800 mb-5">
        {{ $title }}
    </h2>
    @if($subtitle)
        <p class="text-lg text-gray-600 leading-relaxed max-w-3xl {{ $center ? 'mx-auto' : '' }}">
            {{ $subtitle }}
        </p>
    @endif
</div>
