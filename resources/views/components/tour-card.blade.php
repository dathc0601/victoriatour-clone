@props(['tour'])

<div class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden group" data-aos="fade-up">
    <!-- Image -->
    <a href="{{ route('tours.show', $tour->slug) }}" class="block relative aspect-[4/3] overflow-hidden">
        @if($tour->getFirstMediaUrl('featured_image'))
            <img src="{{ $tour->getFirstMediaUrl('featured_image') }}" alt="{{ $tour->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        @else
            <img src="https://picsum.photos/seed/tour{{ $tour->id }}/800/600" alt="{{ $tour->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
        @endif

        <!-- Featured Badge -->
        @if($tour->is_featured)
            <div class="absolute top-4 left-4 px-3 py-1 bg-accent-500 text-white text-xs font-medium rounded-full">
                Featured
            </div>
        @endif

        <!-- Duration Badge -->
        <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 text-gray-800 text-xs font-medium rounded-full flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ $tour->duration_days }} {{ Str::plural('Day', $tour->duration_days) }}
        </div>
    </a>

    <!-- Content -->
    <div class="p-5">
        <!-- Categories -->
        @if($tour->categories->count())
            <div class="flex flex-wrap gap-2 mb-3">
                @foreach($tour->categories->take(2) as $category)
                    <span class="text-xs text-primary-500 bg-primary-50 px-2 py-1 rounded">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Title -->
        <h3 class="font-heading font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-500 transition">
            <a href="{{ route('tours.show', $tour->slug) }}">
                {{ $tour->title }}
            </a>
        </h3>

        <!-- Location -->
        <p class="text-sm text-gray-500 flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
            {{ $tour->destination->name }}
            @if($tour->city)
                , {{ $tour->city->name }}
            @endif
        </p>

        <!-- Footer -->
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <!-- Price -->
            <div>
                @if($tour->price_type === 'contact')
                    <span class="text-sm text-gray-500">Contact for price</span>
                @else
                    <span class="text-xs text-gray-500">{{ $tour->price_type === 'from' ? 'From' : '' }}</span>
                    <span class="text-lg font-bold text-accent-500">${{ number_format($tour->price) }}</span>
                @endif
            </div>

            <!-- Rating -->
            <div class="flex items-center gap-1">
                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                <span class="text-sm font-medium text-gray-700">{{ number_format($tour->rating, 1) }}</span>
            </div>
        </div>
    </div>
</div>
