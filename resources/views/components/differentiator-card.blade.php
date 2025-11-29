@props(['differentiator'])

<div class="bg-gray-50 rounded-xl p-8 text-center hover:shadow-lg transition group" data-aos="fade-up">
    <!-- Icon -->
    <div class="w-16 h-16 mx-auto mb-6 bg-primary-500 text-white rounded-full flex items-center justify-center group-hover:bg-accent-500 transition">
        @if($differentiator->icon)
            <span class="text-3xl">{!! $differentiator->icon !!}</span>
        @else
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        @endif
    </div>

    <!-- Title -->
    <h3 class="text-xl font-heading font-semibold text-gray-900 mb-3">
        {{ $differentiator->title }}
    </h3>

    <!-- Description -->
    @if($differentiator->description)
        <p class="text-gray-600 leading-relaxed">
            {{ $differentiator->description }}
        </p>
    @endif
</div>
