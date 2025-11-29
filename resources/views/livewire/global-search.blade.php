<div class="relative" x-data="{ open: @entangle('showDropdown').live }" @click.away="open = false">
    <!-- Search Input -->
    <div class="relative">
        <input
            type="text"
            wire:model.live.debounce.300ms="query"
            placeholder="Search tours, destinations..."
            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 text-sm"
            @focus="if($wire.query.length >= 2) open = true"
            @keydown.escape="open = false"
            @keydown.enter.prevent="if($wire.query.length >= 2) window.location.href = '{{ route('search') }}?q=' + $wire.query"
        >
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <!-- Loading Spinner -->
        <div wire:loading class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <svg class="animate-spin h-5 w-5 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </div>

    <!-- Dropdown Results -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute z-50 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden"
        x-cloak
    >
        @if(count($results['tours'] ?? []) || count($results['destinations'] ?? []) || count($results['posts'] ?? []))
            <div class="max-h-96 overflow-y-auto">
                <!-- Tours -->
                @if(count($results['tours'] ?? []))
                    <div class="p-2">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 py-2">Tours</h4>
                        @foreach($results['tours'] as $item)
                            <a href="{{ $item['url'] }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-12 h-12 rounded-lg object-cover">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['subtitle'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Destinations -->
                @if(count($results['destinations'] ?? []))
                    <div class="p-2 border-t border-gray-100">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 py-2">Destinations</h4>
                        @foreach($results['destinations'] as $item)
                            <a href="{{ $item['url'] }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-12 h-12 rounded-lg object-cover">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['subtitle'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                <!-- Blog Posts -->
                @if(count($results['posts'] ?? []))
                    <div class="p-2 border-t border-gray-100">
                        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 py-2">Blog Posts</h4>
                        @foreach($results['posts'] as $item)
                            <a href="{{ $item['url'] }}" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-50 transition">
                                <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-12 h-12 rounded-lg object-cover">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item['title'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['subtitle'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- View All Results -->
            <div class="p-3 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('search') }}?q={{ $query }}" class="flex items-center justify-center gap-2 text-sm font-medium text-primary-500 hover:text-primary-600">
                    View all results for "{{ $query }}"
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        @elseif(strlen($query) >= 2)
            <div class="p-8 text-center">
                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <p class="text-gray-500">No results found for "{{ $query }}"</p>
                <p class="text-sm text-gray-400 mt-1">Try different keywords</p>
            </div>
        @endif
    </div>
</div>
