<div>
    {{-- Collapsible Filters --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-8" x-data="{ showFilters: false }">
        <div class="flex flex-col lg:flex-row gap-4">
            {{-- Mobile Toggle --}}
            <button @click="showFilters = !showFilters" class="lg:hidden flex items-center gap-2 text-gray-700 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <span x-text="showFilters ? '{{ __('messages.tours.hide_filters') }}' : '{{ __('messages.tours.show_filters') }}'">{{ __('messages.tours.show_filters') }}</span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': showFilters }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- Filters Row (NO destination filter - moved to tabs) --}}
            <div class="flex-1 flex flex-wrap gap-3" :class="{ 'hidden lg:flex': !showFilters }">
                {{-- Category Filter --}}
                <div class="relative">
                    <select wire:model.live="category" class="appearance-none pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-sm min-w-[160px]">
                        <option value="">{{ __('messages.all_categories') }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                {{-- Duration Filter --}}
                <div class="relative">
                    <select wire:model.live="duration" class="appearance-none pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-sm min-w-[140px]">
                        <option value="">{{ __('messages.any_duration') }}</option>
                        <option value="1-3">1-3 {{ __('messages.duration') }}</option>
                        <option value="4-7">4-7 {{ __('messages.duration') }}</option>
                        <option value="8-14">8-14 {{ __('messages.duration') }}</option>
                        <option value="15+">15+ {{ __('messages.duration') }}</option>
                    </select>
                    <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                {{-- Price Range Filter --}}
                <div class="relative">
                    <select wire:model.live="priceRange" class="appearance-none pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-sm min-w-[140px]">
                        <option value="">{{ __('messages.any_price') }}</option>
                        <option value="under-500">Under $500</option>
                        <option value="500-1000">$500 - $1,000</option>
                        <option value="1000-2000">$1,000 - $2,000</option>
                        <option value="over-2000">Over $2,000</option>
                    </select>
                    <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                {{-- Clear Filters Button --}}
                @if($hasFilters)
                    <button wire:click="clearFilters" class="flex items-center gap-1 px-4 py-2.5 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        {{ __('messages.tours.clear_all') }}
                    </button>
                @endif
            </div>

            {{-- Sort & Count --}}
            <div class="flex items-center gap-4" :class="{ 'hidden lg:flex': !showFilters }">
                <div class="relative">
                    <select wire:model.live="sortBy" class="appearance-none pl-4 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-white text-sm min-w-[150px]">
                        <option value="default">{{ __('messages.sort_by') }}</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="duration-short">Duration: Shortest</option>
                        <option value="duration-long">Duration: Longest</option>
                        <option value="newest">Newest First</option>
                    </select>
                    <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>

                <span class="text-gray-500 text-sm whitespace-nowrap">
                    <span wire:loading.remove wire:target="category, duration, priceRange, sortBy, clearFilters, gotoPage">
                        {{ $tours->total() }} {{ Str::plural('tour', $tours->total()) }}
                    </span>
                    <span wire:loading wire:target="category, duration, priceRange, sortBy, clearFilters, gotoPage" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Loading...
                    </span>
                </span>
            </div>
        </div>

        {{-- Active Filters Tags --}}
        @if($hasFilters && ($category || $duration || $priceRange))
            <div class="mt-4 pt-4 border-t flex flex-wrap gap-2">
                <span class="text-sm text-gray-500">Active filters:</span>
                @if($category)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-accent-100 text-accent-700 rounded-full text-sm">
                        {{ $categories->firstWhere('slug', $category)?->name ?? $category }}
                        <button wire:click="$set('category', '')" class="hover:text-accent-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                @endif
                @if($duration)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">
                        {{ $duration }} Days
                        <button wire:click="$set('duration', '')" class="hover:text-blue-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                @endif
                @if($priceRange)
                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                        @php
                            $priceLabels = [
                                'under-500' => 'Under $500',
                                '500-1000' => '$500 - $1,000',
                                '1000-2000' => '$1,000 - $2,000',
                                'over-2000' => 'Over $2,000',
                            ];
                        @endphp
                        {{ $priceLabels[$priceRange] ?? $priceRange }}
                        <button wire:click="$set('priceRange', '')" class="hover:text-green-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </span>
                @endif
            </div>
        @endif
    </div>

    {{-- Tours Grid - 4 columns --}}
    <div wire:loading.class="opacity-50" wire:target="category, duration, priceRange, sortBy, clearFilters, gotoPage">
        @if($tours->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($tours as $tour)
                    <x-tour-card :tour="$tour" />
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($tours->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $tours->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-xl font-heading font-semibold text-gray-700 mb-2">
                    {{ __('messages.tours.no_tours') }}
                </h3>
                <p class="text-gray-500 mb-6">{{ __('messages.tours.no_tours_desc') }}</p>
                <button wire:click="clearFilters" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    {{ __('messages.tours.reset_filters') }}
                </button>
            </div>
        @endif
    </div>
</div>
