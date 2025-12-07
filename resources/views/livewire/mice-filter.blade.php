<div class="mice-filter-wrapper">
    {{-- ============================================
         STICKY FILTER BAR
         ============================================ --}}
{{--    <div class="mice-filter-bar"--}}
{{--         x-data="{ isSticky: false }"--}}
{{--         x-init="--}}
{{--             const heroEl = document.querySelector('[data-mice-hero]');--}}
{{--             if (heroEl) {--}}
{{--                 const observer = new IntersectionObserver(--}}
{{--                     ([e]) => isSticky = !e.isIntersecting,--}}
{{--                     { threshold: 0, rootMargin: '-80px 0px 0px 0px' }--}}
{{--                 );--}}
{{--                 observer.observe(heroEl);--}}
{{--             }--}}
{{--         "--}}
{{--         :class="{ 'is-sticky': isSticky }">--}}
{{--        <div class="container mx-auto px-4">--}}
{{--            <div class="flex flex-wrap items-end justify-center gap-3 md:gap-4 py-4">--}}
{{--                --}}{{-- Countries Dropdown --}}
{{--                <div class="mice-filter-select-wrapper">--}}
{{--                    <label class="mice-filter-label">{{ __('messages.mice.filter_country') }}</label>--}}
{{--                    <div class="relative">--}}
{{--                        <select wire:model.live="country"--}}
{{--                                class="mice-filter-select">--}}
{{--                            <option value="">{{ __('messages.mice.all_countries') }}</option>--}}
{{--                            @foreach($destinations as $dest)--}}
{{--                                <option value="{{ $dest->slug }}">{{ $dest->name }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <svg class="mice-filter-select-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Regions Dropdown --}}
{{--                <div class="mice-filter-select-wrapper">--}}
{{--                    <label class="mice-filter-label">{{ __('messages.mice.filter_region') }}</label>--}}
{{--                    <div class="relative">--}}
{{--                        <select wire:model.live="region"--}}
{{--                                class="mice-filter-select"--}}
{{--                                @if($regions->isEmpty()) disabled @endif>--}}
{{--                            <option value="">{{ __('messages.mice.all_regions') }}</option>--}}
{{--                            @foreach($regions as $r)--}}
{{--                                <option value="{{ $r }}">{{ $r }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <svg class="mice-filter-select-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Delegates Dropdown --}}
{{--                <div class="mice-filter-select-wrapper">--}}
{{--                    <label class="mice-filter-label">{{ __('messages.mice.filter_delegates') }}</label>--}}
{{--                    <div class="relative">--}}
{{--                        <select wire:model.live="delegates"--}}
{{--                                class="mice-filter-select">--}}
{{--                            <option value="">{{ __('messages.mice.any_delegates') }}</option>--}}
{{--                            <option value="10-50">10 - 50</option>--}}
{{--                            <option value="50-100">50 - 100</option>--}}
{{--                            <option value="100-300">100 - 300</option>--}}
{{--                            <option value="300-500">300 - 500</option>--}}
{{--                            <option value="500+">500+</option>--}}
{{--                        </select>--}}
{{--                        <svg class="mice-filter-select-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Search Button --}}
{{--                <button class="mice-search-btn">--}}
{{--                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>--}}
{{--                    </svg>--}}
{{--                    <span>{{ __('messages.mice.search') }}</span>--}}
{{--                </button>--}}

{{--                --}}{{-- Clear All Filters --}}
{{--                @if($hasAnyFilters)--}}
{{--                    <button wire:click="clearAll"--}}
{{--                            class="mice-clear-btn">--}}
{{--                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
{{--                        </svg>--}}
{{--                        <span>{{ __('messages.mice.clear_all') }}</span>--}}
{{--                    </button>--}}
{{--                @endif--}}

{{--                --}}{{-- Loading Indicator --}}
{{--                <div wire:loading wire:target="country, region, delegates, clearFilters, clearAll, selectCountry"--}}
{{--                     class="flex items-center gap-2 text-amber-600">--}}
{{--                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">--}}
{{--                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>--}}
{{--                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{-- ============================================
         CONTENT AREA
         ============================================ --}}
    <section class="mice-content-section py-16 md:py-24">
        <div class="container mx-auto px-4">
            {{-- Results Header --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-10">
                <div>
                    <h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900">
                        @if($country)
                            @php
                                $currentDest = $destinations->firstWhere('slug', $country);
                            @endphp
                            {{ __('messages.mice.venues_in', ['name' => $currentDest?->name ?? 'Selected']) }}
                        @else
                            {{ __('messages.mice.all_venues') }}
                        @endif
                    </h2>
                    <p class="text-gray-500 mt-1">
                        {{ trans_choice('messages.mice.results_count', $contents->count(), ['count' => $contents->count()]) }}
                    </p>
                </div>

                {{-- Active Filters Tags --}}
                @if($hasFilters)
                    <div class="flex flex-wrap items-center gap-2">
                        @if($region)
                            <span class="mice-filter-tag">
                                {{ $region }}
                                <button wire:click="$set('region', '')" class="ml-1 hover:text-red-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </span>
                        @endif
                        @if($delegates)
                            <span class="mice-filter-tag">
                                {{ $delegates }} {{ __('messages.mice.delegates') }}
                                <button wire:click="$set('delegates', '')" class="ml-1 hover:text-red-600">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </span>
                        @endif
                    </div>
                @endif
            </div>

            {{-- ============================================
             COUNTRY TABS (Horizontal Scrollable)
             ============================================ --}}
            <div class="mice-tabs-section my-8 md:my-12">
                <div class="container mx-auto px-4 flex items-center justify-center">
                    <nav class="mice-tabs-scroll flex items-center justify-center gap-2 md:gap-4 px-4 py-2 bg-gray-200 rounded-4xl overflow-x-auto hide-scrollbar">
                        {{-- All Tab --}}
                        <button wire:click="selectCountry('')"
                                class="mice-tab {{ $country === '' ? 'active' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                            <span>{{ __('messages.mice.all') }}</span>
                        </button>

                        {{-- Country Tabs --}}
                        @foreach($destinations as $dest)
                            <button wire:click="selectCountry('{{ $dest->slug }}')"
                                    class="mice-tab {{ $country === $dest->slug ? 'active' : '' }}">
                                <span>{{ $dest->name }}</span>
                            </button>
                        @endforeach
                    </nav>
                </div>
            </div>

            {{-- Content Grid --}}
            <div wire:loading.class="opacity-50 pointer-events-none"
                 wire:target="country, region, delegates, clearFilters, clearAll, selectCountry"
                 class="transition-opacity duration-300">
                @if($contents->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($contents as $content)
                            <x-mice-content-card :content="$content" :index="$loop->index" />
                        @endforeach
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="mice-empty-state text-center py-20">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-2xl bg-gray-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-heading font-bold text-gray-700 mb-3">
                            {{ __('messages.mice.no_results') }}
                        </h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">
                            {{ __('messages.mice.no_results_desc') }}
                        </p>
                        <button wire:click="clearAll"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-full transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            {{ __('messages.mice.reset_filters') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>
</div>
