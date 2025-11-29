@props(['destination'])

<a href="{{ route('destinations.show', $destination->slug) }}" class="group block relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition" data-aos="fade-up">
    <!-- Image -->
    <div class="aspect-[4/3] overflow-hidden">
        @if($destination->getFirstMediaUrl('image'))
            <img src="{{ $destination->getFirstMediaUrl('image') }}" alt="{{ $destination->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        @else
            <img src="https://picsum.photos/seed/dest{{ $destination->id }}/800/600" alt="{{ $destination->name }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        @endif
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

    <!-- Content -->
    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
        <h3 class="text-2xl font-heading font-bold mb-2 group-hover:text-accent-400 transition">
            {{ $destination->name }}
        </h3>
        @if($destination->tours_count ?? $destination->tours->count() ?? 0)
            <p class="text-gray-300 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                {{ $destination->tours_count ?? $destination->tours->count() }} Tours Available
            </p>
        @endif
    </div>

    <!-- Hover Arrow -->
    <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition transform translate-x-2 group-hover:translate-x-0">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
    </div>
</a>
