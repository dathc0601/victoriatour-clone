@props(['hotel'])

<div class="hotel-card block">
    {{-- Image Container --}}
    <div class="hotel-card-image relative rounded-2xl overflow-hidden">
        @if($hotel->getFirstMediaUrl('featured_image'))
            <img src="{{ $hotel->getFirstMediaUrl('featured_image') }}"
                 alt="{{ $hotel->name }}"
                 loading="lazy"
                 class="w-full h-full object-cover">
        @else
            <img src="https://picsum.photos/seed/hotel{{ $hotel->id }}/600/450"
                 alt="{{ $hotel->name }}"
                 loading="lazy"
                 class="w-full h-full object-cover">
        @endif

        {{-- Rating Badge --}}
        <div class="hotel-card-rating">
            <span class="text-gray-800">{{ number_format($hotel->rating, 1) }}</span>
            <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20">
                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
            </svg>
        </div>
    </div>

    {{-- Content --}}
    <div class="hotel-card-content">
        <h3 class="hotel-card-name line-clamp-1">{{ $hotel->name }}</h3>
        <p class="hotel-card-address">{{ $hotel->address }}</p>

        <div class="flex items-center justify-between">
            <span class="text-sm text-gray-500">
                @if($hotel->room_types && count($hotel->room_types) > 0)
                    {{ $hotel->room_types[0]['name'] ?? __('messages.destination.room_only') }}
                @else
                    {{ __('messages.destination.room_only') }}
                @endif
            </span>
            <span class="hotel-card-price">
                {{ $hotel->formatted_price }}<span class="text-sm font-normal text-gray-500">/{{ __('messages.destination.night') }}</span>
            </span>
        </div>
    </div>
</div>
