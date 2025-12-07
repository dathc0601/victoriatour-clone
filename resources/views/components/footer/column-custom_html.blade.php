@props(['column'])

@php
    $settings = $column->settings ?? [];
    $locale = app()->getLocale();
    $html = $settings['html_' . $locale] ?? $settings['html_en'] ?? '';
@endphp

<div>
    <h3 class="text-base font-medium mb-5">{{ $column->title }}</h3>

    @if($html)
        <div class="text-sm text-gray-300 font-light leading-relaxed prose prose-invert prose-sm max-w-none">
            {!! $html !!}
        </div>
    @else
        <p class="text-sm text-gray-400 font-light">No content configured.</p>
    @endif
</div>
