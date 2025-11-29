@props(['items' => []])

@if(count($items) > 0)
<nav aria-label="Breadcrumb" class="py-4">
    <ol class="flex items-center flex-wrap gap-2 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
        {{-- Home --}}
        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex items-center">
            <a href="{{ route('home') }}" itemprop="item" class="text-gray-500 hover:text-primary-500 transition flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span itemprop="name" class="sr-only md:not-sr-only">{{ __('navigation.home') }}</span>
            </a>
            <meta itemprop="position" content="1" />
        </li>

        @foreach($items as $index => $item)
            <li class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </li>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="flex items-center">
                @if(isset($item['url']) && $index < count($items) - 1)
                    <a href="{{ $item['url'] }}" itemprop="item" class="text-gray-500 hover:text-primary-500 transition truncate max-w-[150px] md:max-w-none">
                        <span itemprop="name">{{ $item['name'] }}</span>
                    </a>
                @else
                    <span itemprop="item" class="text-primary-500 font-medium truncate max-w-[150px] md:max-w-none" aria-current="page">
                        <span itemprop="name">{{ $item['name'] }}</span>
                    </span>
                @endif
                <meta itemprop="position" content="{{ $index + 2 }}" />
            </li>
        @endforeach
    </ol>
</nav>

{{-- JSON-LD Structured Data --}}
@php
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => __('navigation.home'),
                'item' => route('home'),
            ],
        ],
    ];
    foreach ($items as $index => $item) {
        $listItem = [
            '@type' => 'ListItem',
            'position' => $index + 2,
            'name' => $item['name'],
        ];
        if (isset($item['url'])) {
            $listItem['item'] = $item['url'];
        }
        $jsonLd['itemListElement'][] = $listItem;
    }
@endphp

@push('json-ld')
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush
@endif
