<header class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false, destinationDropdown: false }">
    <!-- Top Bar -->
    <div class="bg-primary-500 text-white py-2 text-sm hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="mailto:{{ App\Models\Setting::get('email', 'info@victoriatour.com') }}" class="flex items-center gap-1 hover:text-accent-400 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ App\Models\Setting::get('email', 'info@victoriatour.com') }}
                </a>
            </div>
            <div class="flex items-center gap-4">
                <a href="tel:{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}" class="flex items-center gap-1 hover:text-accent-400 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ App\Models\Setting::get('phone', '+84 85 692 9229') }}
                </a>
                <!-- Language Switcher -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-1 hover:text-accent-400 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        {{ strtoupper($currentLocale ?? app()->getLocale()) }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-50">
                        @foreach($languages ?? App\Models\Language::active()->ordered()->get() as $lang)
                            <a href="{{ request()->fullUrlWithQuery(['lang' => $lang->code]) }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ ($currentLocale ?? app()->getLocale()) === $lang->code ? 'bg-primary-50 text-primary-500' : '' }}">
                                @if($lang->flag_icon)
                                    <span>{{ $lang->flag_icon }}</span>
                                @endif
                                {{ $lang->native_name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="container mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0">
                <span class="text-2xl font-heading font-bold text-primary-500">Victoria<span class="text-accent-500">Tour</span></span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="font-medium text-gray-700 hover:text-primary-500 transition {{ request()->routeIs('home') ? 'text-primary-500' : '' }}">
                    {{ __('navigation.home') }}
                </a>
                <a href="{{ url('/about-us') }}" class="font-medium text-gray-700 hover:text-primary-500 transition {{ request()->is('about-us') ? 'text-primary-500' : '' }}">
                    {{ __('navigation.about') }}
                </a>

                <!-- Destinations Dropdown -->
                <div class="relative" @mouseenter="destinationDropdown = true" @mouseleave="destinationDropdown = false">
                    <a href="{{ route('destinations.index') }}" class="font-medium text-gray-700 hover:text-primary-500 transition flex items-center gap-1 {{ request()->routeIs('destinations.*') ? 'text-primary-500' : '' }}">
                        {{ __('navigation.destinations') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                    <div x-show="destinationDropdown" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                        @foreach($destinations ?? App\Models\Destination::active()->ordered()->get() as $destination)
                            <a href="{{ route('destinations.show', $destination->slug) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-500">
                                {{ $destination->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('tours.index') }}" class="font-medium text-gray-700 hover:text-primary-500 transition {{ request()->routeIs('tours.*') ? 'text-primary-500' : '' }}">
                    {{ __('navigation.tours') }}
                </a>
                <a href="{{ route('blog.index') }}" class="font-medium text-gray-700 hover:text-primary-500 transition {{ request()->routeIs('blog.*') ? 'text-primary-500' : '' }}">
                    {{ __('navigation.blog') }}
                </a>
                <a href="{{ url('/mice') }}" class="font-medium text-gray-700 hover:text-primary-500 transition {{ request()->is('mice') ? 'text-primary-500' : '' }}">
                    {{ __('navigation.mice') }}
                </a>
                <a href="{{ route('contact') }}" class="font-medium text-gray-700 hover:text-primary-500 transition {{ request()->routeIs('contact') ? 'text-primary-500' : '' }}">
                    {{ __('navigation.contact') }}
                </a>
            </div>

            <!-- Search & CTA -->
            <div class="hidden lg:flex items-center gap-4">
                <!-- Global Search -->
                <div class="w-64">
                    <livewire:global-search />
                </div>
                <!-- CTA Button -->
                <a href="{{ route('contact') }}" class="inline-flex items-center px-5 py-2.5 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition shadow-md hover:shadow-lg">
                    {{ __('buttons.book_now') }}
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-md text-gray-700 hover:bg-gray-100 transition">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak class="lg:hidden border-t py-4">
            <div class="flex flex-col gap-2">
                <!-- Mobile Search -->
                <div class="px-4 pb-2">
                    <livewire:global-search />
                </div>
                <a href="{{ route('home') }}" class="px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-500 rounded-lg transition">{{ __('navigation.home') }}</a>
                <a href="{{ url('/about-us') }}" class="px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-500 rounded-lg transition">{{ __('navigation.about') }}</a>
                <a href="{{ route('destinations.index') }}" class="px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-500 rounded-lg transition">{{ __('navigation.destinations') }}</a>
                <a href="{{ route('tours.index') }}" class="px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-500 rounded-lg transition">{{ __('navigation.tours') }}</a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-500 rounded-lg transition">{{ __('navigation.blog') }}</a>
                <a href="{{ url('/mice') }}" class="px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-500 rounded-lg transition">{{ __('navigation.mice') }}</a>
                <a href="{{ route('contact') }}" class="px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-500 rounded-lg transition">{{ __('navigation.contact') }}</a>
                <div class="px-4 pt-2">
                    <a href="{{ route('contact') }}" class="block w-full text-center px-5 py-2.5 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition">
                        {{ __('buttons.book_now') }}
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
