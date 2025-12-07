<div>
@if($modalMode)
    {{-- Modal Mode Layout --}}
    <div class="w-full" x-data="{ focused: false }">
        <!-- Search Input -->
        <div class="relative mb-8">
            <input
                type="text"
                wire:model.live.debounce.300ms="query"
                placeholder="{{ __('navigation.search') }}..."
                class="w-full px-6 py-5 text-xl bg-white/10 border-2 border-white/20 rounded-2xl text-white placeholder-white/50 focus:border-white/40 focus:ring-0 focus:outline-none transition-all duration-300"
                @focus="focused = true"
                @keydown.enter.prevent="if($wire.query.length >= 2) window.location.href = '{{ route('search') }}?q=' + $wire.query"
            >
            <div class="absolute inset-y-0 right-0 pr-6 flex items-center pointer-events-none">
                <!-- Loading Spinner -->
                <div wire:loading>
                    <svg class="animate-spin h-6 w-6 text-white/70" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <div wire:loading.remove>
                    <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Results -->
        @if(count($results['tours'] ?? []) || count($results['destinations'] ?? []) || count($results['posts'] ?? []))
            <div class="space-y-6 max-h-[50vh] overflow-y-auto custom-scrollbar">
                <!-- Tours -->
                @if(count($results['tours'] ?? []))
                    <div>
                        <h4 class="text-sm font-semibold text-white/60 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            {{ __('navigation.tours') }}
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($results['tours'] as $item)
                                <a href="{{ $item['url'] }}" class="group flex items-center gap-4 p-4 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-300 border border-white/10 hover:border-white/20">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-16 h-16 rounded-lg object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-medium truncate group-hover:text-accent-400 transition-colors">{{ $item['title'] }}</p>
                                        <p class="text-sm text-white/60">{{ $item['subtitle'] }}</p>
                                    </div>
                                    <svg class="w-5 h-5 text-white/30 group-hover:text-white/60 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Destinations -->
                @if(count($results['destinations'] ?? []))
                    <div>
                        <h4 class="text-sm font-semibold text-white/60 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ __('navigation.destinations') }}
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            @foreach($results['destinations'] as $item)
                                <a href="{{ $item['url'] }}" class="group flex items-center gap-3 p-4 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-300 border border-white/10 hover:border-white/20">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-12 h-12 rounded-lg object-cover">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-medium truncate group-hover:text-accent-400 transition-colors">{{ $item['title'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Blog Posts -->
                @if(count($results['posts'] ?? []))
                    <div>
                        <h4 class="text-sm font-semibold text-white/60 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                            {{ __('navigation.blog') }}
                        </h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($results['posts'] as $item)
                                <a href="{{ $item['url'] }}" class="group flex items-center gap-4 p-4 bg-white/5 hover:bg-white/10 rounded-xl transition-all duration-300 border border-white/10 hover:border-white/20">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="w-16 h-16 rounded-lg object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-white font-medium truncate group-hover:text-accent-400 transition-colors">{{ $item['title'] }}</p>
                                        <p class="text-sm text-white/60">{{ $item['subtitle'] }}</p>
                                    </div>
                                    <svg class="w-5 h-5 text-white/30 group-hover:text-white/60 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- View All Results -->
            <div class="mt-6 pt-6 border-t border-white/10 text-center">
                <a href="{{ route('search') }}?q={{ $query }}" class="inline-flex items-center gap-2 px-6 py-3 bg-accent-500 hover:bg-accent-600 text-white font-medium rounded-xl transition-all duration-300 hover:scale-105">
                    {{ __('navigation.search_results') }} "{{ $query }}"
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        @elseif(strlen($query) >= 2)
            <div class="text-center py-12">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-white/5 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <p class="text-white/70 text-lg mb-2">No results found for "{{ $query }}"</p>
                <p class="text-white/40">Try different keywords or browse our destinations</p>
            </div>
        @elseif(strlen($query) === 0)
            {{-- Quick Links when no search query --}}
            <div class="text-center py-8">
                <p class="text-white/50 mb-6">Popular searches</p>
                <div class="flex flex-wrap justify-center gap-2">
                    @foreach(['Vietnam', 'Halong Bay', 'Beach Tours', 'Hanoi', 'Ho Chi Minh'] as $term)
                        <button
                            wire:click="$set('query', '{{ $term }}')"
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 rounded-full text-white/80 hover:text-white text-sm transition-all duration-300"
                        >
                            {{ $term }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
@else
    {{-- Default Dropdown Mode Layout --}}
    <div class="relative" x-data="{ open: @entangle('showDropdown').live }" @click.away="open = false">
        <!-- Search Input -->
        <div class="relative">
            <input
                type="text"
                wire:model.live.debounce.300ms="query"
                placeholder="{{ __('navigation.search') }}..."
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
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 py-2">{{ __('navigation.tours') }}</h4>
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
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 py-2">{{ __('navigation.destinations') }}</h4>
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
                            <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 py-2">{{ __('navigation.blog') }}</h4>
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
                        {{ __('navigation.search_results') }} "{{ $query }}"
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
@endif
</div>
