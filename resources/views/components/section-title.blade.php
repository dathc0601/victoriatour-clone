@props(['title', 'subtitle' => null, 'center' => true])

<div class="{{ $center ? 'text-center' : '' }} max-w-3xl {{ $center ? 'mx-auto' : '' }}" data-aos="fade-up">
    <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4">
        {{ $title }}
    </h2>
    @if($subtitle)
        <p class="text-lg text-gray-600">
            {{ $subtitle }}
        </p>
    @endif
</div>
