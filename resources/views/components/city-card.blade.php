@props(['city', 'destination'])

<a href="{{ route('tours.destination', $destination->slug) }}"
   class="city-card block relative rounded-2xl overflow-hidden group"
   data-aos="fade-up">

    {{-- Background Image --}}
    @if($city->getFirstMediaUrl('image'))
        <img src="{{ $city->getFirstMediaUrl('image') }}"
             alt="{{ $city->name }}"
             loading="lazy"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    @else
        <img src="https://picsum.photos/seed/city{{ $city->id }}/600/450"
             alt="{{ $city->name }}"
             loading="lazy"
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    @endif

    {{-- Gradient Overlay --}}
    <div class="city-overlay absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

    {{-- Tour Count Badge --}}
    <div class="absolute top-4 right-4 px-3 py-1.5 bg-amber-500 text-white text-xs font-semibold rounded-full">
        {{ $city->tours_count ?? 0 }} {{ Str::plural('Tour', $city->tours_count ?? 0) }}
    </div>

    {{-- Destination Badge --}}
    <div class="absolute top-4 left-4 px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-medium rounded-full">
        1 {{ __('messages.destination.destination') }}
    </div>

    {{-- City Name --}}
    <div class="city-content absolute bottom-0 left-0 right-0 p-5 text-white">
        <h3 class="text-xl font-heading font-bold group-hover:text-accent-400 transition-colors duration-300">
            {{ $city->name }}
        </h3>
    </div>
</a>
