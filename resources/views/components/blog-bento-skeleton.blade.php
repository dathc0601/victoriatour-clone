@props(['size' => 'standard'])

@php
$sizeClasses = match($size) {
    'large' => 'col-span-2 row-span-2',
    'wide' => 'col-span-2',
    'tall' => 'row-span-2',
    default => '',
};
@endphp

<article class="blog-bento-skeleton {{ $sizeClasses }}">
    {{-- Animated shimmer background --}}
    <div class="skeleton-shimmer"></div>

    {{-- Content placeholder --}}
    <div class="skeleton-content">
        {{-- Category placeholder --}}
        <div class="skeleton-category"></div>

        {{-- Title placeholder --}}
        <div class="skeleton-title">
            <div class="skeleton-line"></div>
            <div class="skeleton-line short"></div>
        </div>

        {{-- Date placeholder --}}
        <div class="skeleton-date"></div>
    </div>
</article>
