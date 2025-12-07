<header
    id="header"
    x-data="headerController()"
    x-init="init()"
    :class="{
        'header-scrolled': scrolled,
        'header-hidden': hidden,
        'header-visible': !hidden
    }"
    class="fixed top-0 left-0 right-0 z-[1000] transition-all duration-500 ease-out"
>
    @php
        $headerLogo = App\Models\Setting::get('header_logo');
    @endphp

    <!-- Mobile Header -->
    <div id="header-mobi" class="lg:hidden flex justify-between items-center h-[80px] px-4">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex-shrink-0 logo-link">
            @if($headerLogo)
                <img src="{{ Storage::url($headerLogo) }}" alt="{{ config('app.name') }}" class="h-10 transition-all duration-300">
            @else
                <span class="text-2xl font-heading font-bold tracking-tight">
                    <span class="logo-victoria transition-colors duration-300" :class="scrolled ? 'text-primary-500' : 'text-white'">Victoria</span><span class="logo-tour transition-colors duration-300" :class="scrolled ? 'text-accent-500' : 'text-accent-400'">Tour</span>
                </span>
            @endif
        </a>

        <div class="flex items-center gap-3">
            <!-- Mobile Language Selector -->
            <div class="relative" x-data="{ langOpen: false }">
                <button
                    @click="langOpen = !langOpen"
                    class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg transition-all duration-300 lang-button"
                    :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/15'"
                >
                    <span class="lang-flag">
                        @php $currentLang = app()->getLocale(); @endphp
                        <img src="{{ asset('images/flags/' . $currentLang . '.svg') }}" alt="" class="w-5 h-5 rounded-sm object-cover">
                    </span>
                    <svg class="w-3.5 h-3.5 transition-all duration-300 lang-chevron" :class="[{ 'rotate-180': langOpen }, scrolled ? 'text-gray-700' : 'text-white']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div
                    x-show="langOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    @click.away="langOpen = false"
                    class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-2xl shadow-black/10 py-2 z-50 border border-gray-100 overflow-hidden"
                >
                    @foreach(App\Models\Language::active()->ordered()->get() as $lang)
                        <a
                            href="{{ request()->fullUrlWithQuery(['lang' => $lang->code]) }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200 {{ $currentLang === $lang->code ? 'bg-primary-50 text-primary-600 font-medium' : '' }}"
                        >
                            <img src="{{ asset('images/flags/' . $lang->code . '.svg') }}" alt="" class="w-5 h-5 rounded-sm object-cover shadow-sm">
                            <span>{{ $lang->native_name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Hamburger Menu Button -->
            <button
                @click="openSidenav()"
                class="p-2 rounded-lg transition-all duration-300 hamburger-button"
                :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/15'"
                aria-label="Open menu"
            >
                <svg class="w-6 h-6 transition-colors duration-300" :class="scrolled ? 'text-gray-700' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Desktop Header -->
    <div class="header-layout hidden lg:flex justify-between items-center h-[100px] px-8 xl:px-16 max-w-[1800px] mx-auto">
        <!-- Left Section: Logo + Navigation -->
        <div class="header-layout1 flex items-center gap-12">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0 logo-link group">
                @if($headerLogo)
                    <img src="{{ Storage::url($headerLogo) }}" alt="{{ config('app.name') }}" class="h-12 transition-all duration-300 group-hover:scale-105">
                @else
                    <span class="text-[28px] font-heading font-bold tracking-tight">
                        <span class="logo-victoria transition-all duration-300 group-hover:tracking-wide" :class="scrolled ? 'text-primary-500' : 'text-white'">Victoria</span><span class="logo-tour transition-all duration-300 text-accent-500" :class="scrolled ? 'text-accent-500' : 'text-accent-400'">Tour</span>
                    </span>
                @endif
            </a>

            <!-- Primary Navigation -->
            <nav class="flex items-center gap-1">
                @foreach(navigation('header') as $item)
                    @if($item->hasChildren())
                        {{-- Dropdown Menu --}}
                        <div class="relative" x-data="{ dropOpen: false }" @mouseenter="dropOpen = true" @mouseleave="dropOpen = false">
                            <a
                                href="{{ menu_url($item) ?? '#' }}"
                                target="{{ $item->target }}"
                                class="nav-link flex items-center gap-1.5 px-4 py-2 text-[15px] font-medium tracking-wide transition-all duration-300 rounded-lg"
                                :class="scrolled ? 'text-gray-700 hover:text-primary-600 hover:bg-primary-50' : 'text-white hover:bg-white/15'"
                            >
                                {{ $item->title }}
                                <svg class="w-4 h-4 transition-transform duration-300" :class="[{ 'rotate-180': dropOpen }, scrolled ? 'text-gray-700' : 'text-white']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </a>

                            {{-- Dropdown Panel --}}
                            <div
                                x-show="dropOpen"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-4"
                                class="absolute left-0 top-full pt-4"
                            >
                                <div class="bg-white rounded-2xl shadow-2xl shadow-black/10 p-4 min-w-[240px] border border-gray-100">
                                    <div class="space-y-1">
                                        @foreach($item->children as $child)
                                            <a
                                                href="{{ menu_url($child) }}"
                                                target="{{ $child->target }}"
                                                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200"
                                            >
                                                @if($child->icon)
                                                    <x-dynamic-component :component="$child->icon" class="w-4 h-4" />
                                                @else
                                                    <span class="w-1.5 h-1.5 rounded-full bg-primary-400"></span>
                                                @endif
                                                {{ $child->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Simple Link --}}
                        <a
                            href="{{ menu_url($item) }}"
                            target="{{ $item->target }}"
                            class="nav-link px-4 py-2 text-[15px] font-medium tracking-wide transition-all duration-300 rounded-lg"
                            :class="scrolled ? 'text-gray-700 hover:text-primary-600 hover:bg-primary-50' : 'text-white hover:bg-white/15'"
                        >
                            {{ $item->title }}
                        </a>
                    @endif
                @endforeach
            </nav>
        </div>

        <!-- Right Section: Phone, Language, Search -->
        <div class="header-layout2 flex items-center gap-6">
            <!-- Hotline -->
            <a href="tel:{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}" class="hotline-link group flex items-center gap-3 transition-all duration-300">
                <div class="hotline-icon-wrapper relative">
                    <div class="absolute inset-0 bg-accent-500/20 rounded-full animate-ping-slow"></div>
                    <div class="relative w-10 h-10 bg-gradient-to-br from-accent-400 to-accent-600 rounded-full flex items-center justify-center shadow-lg shadow-accent-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] uppercase tracking-wider hotline-label transition-colors duration-300" :class="scrolled ? 'text-gray-500' : 'text-white/70'">Hotline 24/7</span>
                    <span class="text-[15px] font-semibold hotline-number group-hover:tracking-wide transition-all duration-300" :class="scrolled ? 'text-primary-600' : 'text-white'">{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}</span>
                </div>
            </a>

            <!-- Divider -->
            <div class="h-8 w-px header-divider transition-colors duration-300" :class="scrolled ? 'bg-gray-200' : 'bg-white/30'"></div>

            <!-- Desktop Language Selector -->
            <div class="relative" x-data="{ langOpen: false }">
                <button
                    @click="langOpen = !langOpen"
                    class="flex items-center gap-2 px-3 py-2 rounded-lg transition-all duration-300 lang-button"
                    :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/15'"
                >
                    <img src="{{ asset('images/flags/' . app()->getLocale() . '.svg') }}" alt="" class="w-6 h-6 rounded-sm object-cover shadow-sm">
                    <span class="text-sm font-medium lang-text transition-colors duration-300" :class="scrolled ? 'text-gray-700' : 'text-white'">{{ strtoupper(app()->getLocale()) }}</span>
                    <svg class="w-4 h-4 transition-all duration-300 lang-chevron" :class="[{ 'rotate-180': langOpen }, scrolled ? 'text-gray-700' : 'text-white']" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div
                    x-show="langOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    @click.away="langOpen = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-2xl shadow-black/10 py-2 z-50 border border-gray-100 overflow-hidden max-h-[400px] overflow-y-auto"
                >
                    @foreach(App\Models\Language::active()->ordered()->get() as $lang)
                        <a
                            href="{{ request()->fullUrlWithQuery(['lang' => $lang->code]) }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200 {{ app()->getLocale() === $lang->code ? 'bg-primary-50 text-primary-600 font-medium' : '' }}"
                        >
                            <img src="{{ asset('images/flags/' . $lang->code . '.svg') }}" alt="" class="w-5 h-5 rounded-sm object-cover shadow-sm">
                            <span>{{ $lang->native_name }}</span>
                            @if(app()->getLocale() === $lang->code)
                                <svg class="w-4 h-4 ml-auto text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Search Button -->
            <button
                @click="openSearch()"
                class="search-button group relative w-11 h-11 rounded-xl transition-all duration-300 hover:scale-105 flex items-center justify-center"
                :class="scrolled ? 'bg-gray-100 hover:bg-gray-200' : 'bg-white/15 hover:bg-white/25'"
                aria-label="Search"
            >
                <svg class="w-5 h-5 search-icon transition-all duration-300 group-hover:scale-110" :class="scrolled ? 'text-gray-700' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Full-Screen Search Modal - Teleported to body to escape header's stacking context -->
    <template x-teleport="body">
        <div
            x-show="searchOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="closeSearch()"
            class="fixed inset-0 z-[2000] bg-black/90 backdrop-blur-xl flex flex-col"
        >
            <!-- Search Header -->
            <div class="flex items-center justify-between p-6 lg:p-8">
                <a href="{{ route('home') }}" class="flex-shrink-0">
                    <span class="text-2xl font-heading font-bold text-white">
                        Victoria<span class="text-accent-400">Tour</span>
                    </span>
                </a>
                <button
                    @click="closeSearch()"
                    class="w-12 h-12 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 group"
                    aria-label="Close search"
                >
                    <svg class="w-6 h-6 text-white transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Search Content -->
            <div class="flex-1 flex flex-col items-center justify-start pt-[10vh] px-6 lg:px-8 overflow-y-auto">
                <div class="w-full max-w-3xl">
                    <h2 class="text-3xl lg:text-4xl font-heading font-bold text-white text-center mb-8">
                        {{ __('navigation.search') }}
                    </h2>

                    <!-- Livewire Search Component -->
                    <div class="search-modal-content">
                        <livewire:global-search :modal-mode="true" />
                    </div>
                </div>
            </div>

            <!-- Search Footer Hint -->
            <div class="p-6 text-center">
                <p class="text-white/50 text-sm">
                    Press <kbd class="px-2 py-1 bg-white/10 rounded text-white/70 font-mono text-xs">ESC</kbd> to close
                </p>
            </div>
        </div>
    </template>

    <!-- Mobile Sidenav - Teleported to body to escape header's stacking context -->
    <template x-teleport="body">
        <div x-show="sidenavOpen" class="lg:hidden">
            <!-- Mobile Sidenav Overlay -->
            <div
                x-show="sidenavOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="closeSidenav()"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[1001]"
            ></div>

            <!-- Mobile Sidenav -->
            <div
                id="mySidenav"
                x-show="sidenavOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full"
                class="fixed top-0 right-0 h-full w-[300px] bg-white z-[1002] shadow-2xl overflow-y-auto"
            >
        <!-- Sidenav Header -->
        <div class="flex items-center justify-between p-5 border-b border-gray-100">
            <a href="{{ route('home') }}" class="flex-shrink-0">
                @if($headerLogo)
                    <img src="{{ Storage::url($headerLogo) }}" alt="{{ config('app.name') }}" class="h-8">
                @else
                    <span class="text-xl font-heading font-bold">
                        <span class="text-primary-500">Victoria</span><span class="text-accent-500">Tour</span>
                    </span>
                @endif
            </a>
            <button
                @click="closeSidenav()"
                class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-all duration-300"
                aria-label="Close menu"
            >
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Sidenav Navigation -->
        <nav class="p-5 space-y-1">
            {{-- Home Link (always present) --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200 {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-600 font-medium' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">{{ __('navigation.home') }}</span>
            </a>

            {{-- Dynamic Navigation Items --}}
            @foreach(navigation('header') as $item)
                @if($item->hasChildren())
                    {{-- Accordion for items with children --}}
                    <div x-data="{ expanded: false }">
                        <button
                            @click="expanded = !expanded"
                            class="w-full flex items-center justify-between gap-3 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200"
                        >
                            <div class="flex items-center gap-3">
                                @if($item->icon)
                                    <x-dynamic-component :component="$item->icon" class="w-5 h-5" />
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                                    </svg>
                                @endif
                                <span class="font-medium">{{ $item->title }}</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="expanded" x-collapse class="ml-4 mt-1 space-y-1">
                            @foreach($item->children as $child)
                                <a
                                    href="{{ menu_url($child) }}"
                                    target="{{ $child->target }}"
                                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary-300"></span>
                                    {{ $child->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Simple Link --}}
                    <a
                        href="{{ menu_url($item) }}"
                        target="{{ $item->target }}"
                        class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-all duration-200"
                    >
                        @if($item->icon)
                            <x-dynamic-component :component="$item->icon" class="w-5 h-5" />
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        @endif
                        <span class="font-medium">{{ $item->title }}</span>
                    </a>
                @endif
            @endforeach
        </nav>

        <!-- Sidenav Footer -->
        <div class="absolute bottom-0 left-0 right-0 p-5 border-t border-gray-100 bg-gray-50">
            <!-- Search Button -->
            <button
                @click="closeSidenav(); $nextTick(() => openSearch())"
                class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl text-gray-700 font-medium transition-all duration-300 mb-3"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span>{{ __('navigation.search') }}</span>
            </button>

            <!-- Hotline -->
            <a href="tel:{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}" class="flex items-center justify-center gap-2 px-4 py-3 bg-accent-500 hover:bg-accent-600 rounded-xl text-white font-medium transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
                <span>{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}</span>
            </a>
            </div>
            </div>
        </div>
    </template>
</header>

@push('styles')
<style>
    /* Header Base Styles - Transparent State (White Text) */
    #header:not(.header-scrolled) .logo-victoria {
        color: #ffffff !important;
    }

    #header:not(.header-scrolled) .logo-tour {
        color: #2dd4bf !important;
    }

    #header:not(.header-scrolled) .nav-link {
        color: #ffffff !important;
    }

    #header:not(.header-scrolled) .nav-link:hover {
        background: rgba(255, 255, 255, 0.15) !important;
    }

    #header:not(.header-scrolled) .nav-link.nav-active {
        background: rgba(255, 255, 255, 0.2) !important;
    }

    #header:not(.header-scrolled) .hotline-label {
        color: rgba(255, 255, 255, 0.7) !important;
    }

    #header:not(.header-scrolled) .hotline-number {
        color: #ffffff !important;
    }

    #header:not(.header-scrolled) .lang-text,
    #header:not(.header-scrolled) .lang-chevron {
        color: #ffffff !important;
    }

    #header:not(.header-scrolled) .header-divider {
        background: rgba(255, 255, 255, 0.3) !important;
    }

    #header:not(.header-scrolled) .search-button {
        background: rgba(255, 255, 255, 0.15) !important;
    }

    #header:not(.header-scrolled) .search-button:hover {
        background: rgba(255, 255, 255, 0.25) !important;
    }

    #header:not(.header-scrolled) .search-icon {
        color: #ffffff !important;
    }

    #header:not(.header-scrolled) .hamburger-button svg {
        color: #ffffff !important;
    }

    /* Header Scrolled State - Solid White Background (Dark Text) */
    #header.header-scrolled {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
    }

    #header.header-scrolled .logo-victoria {
        color: #1e3a5f !important;
    }

    #header.header-scrolled .logo-tour {
        color: #0d9488 !important;
    }

    #header.header-scrolled .nav-link {
        color: #374151 !important;
    }

    #header.header-scrolled .nav-link:hover {
        background: rgba(30, 58, 95, 0.08) !important;
        color: #1e3a5f !important;
    }

    #header.header-scrolled .nav-link.nav-active {
        background: rgba(30, 58, 95, 0.1) !important;
        color: #1e3a5f !important;
    }

    #header.header-scrolled .hotline-label {
        color: #6b7280 !important;
    }

    #header.header-scrolled .hotline-number {
        color: #1e3a5f !important;
    }

    #header.header-scrolled .lang-text,
    #header.header-scrolled .lang-chevron {
        color: #374151 !important;
    }

    #header.header-scrolled .header-divider {
        background: #e5e7eb !important;
    }

    #header.header-scrolled .search-button {
        background: #f3f4f6 !important;
    }

    #header.header-scrolled .search-button:hover {
        background: #e5e7eb !important;
    }

    #header.header-scrolled .search-icon {
        color: #374151 !important;
    }

    #header.header-scrolled .hamburger-button svg {
        color: #374151 !important;
    }

    /* Header Hidden/Visible States */
    #header.header-hidden {
        transform: translateY(-100%);
    }

    #header.header-visible {
        transform: translateY(0);
    }

    /* Ping Animation for Hotline */
    @keyframes ping-slow {
        0% {
            transform: scale(1);
            opacity: 0.5;
        }
        75%, 100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    .animate-ping-slow {
        animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    /* Search Modal Styles */
    .search-modal-content input {
        background: rgba(255, 255, 255, 0.1) !important;
        border: 2px solid rgba(255, 255, 255, 0.2) !important;
        color: white !important;
        font-size: 1.25rem !important;
        padding: 1.25rem 1.5rem !important;
        border-radius: 1rem !important;
    }

    .search-modal-content input::placeholder {
        color: rgba(255, 255, 255, 0.5) !important;
    }

    .search-modal-content input:focus {
        border-color: rgba(255, 255, 255, 0.4) !important;
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1) !important;
    }
</style>
@endpush
