<footer class="bg-primary-500 text-white">
    <!-- Main Footer -->
    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Company Info -->
            <div>
                <a href="{{ route('home') }}" class="inline-block mb-6">
                    <span class="text-2xl font-heading font-bold text-white">Victoria<span class="text-accent-400">Tour</span></span>
                </a>
                <p class="text-gray-300 mb-6 leading-relaxed">
                    Your trusted travel partner for unforgettable journeys across Southeast Asia. We create memorable experiences that last a lifetime.
                </p>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 mt-0.5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-gray-300">{{ App\Models\Setting::get('address', 'Ho Chi Minh City, Vietnam') }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}" class="text-gray-300 hover:text-accent-400 transition">{{ App\Models\Setting::get('phone', '+84 85 692 9229') }}</a>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-accent-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ App\Models\Setting::get('email', 'info@victoriatour.com') }}" class="text-gray-300 hover:text-accent-400 transition">{{ App\Models\Setting::get('email', 'info@victoriatour.com') }}</a>
                    </div>
                </div>
            </div>

            <!-- Destinations -->
            <div>
                <h3 class="text-lg font-heading font-semibold mb-6">{{ __('navigation.destinations') }}</h3>
                <ul class="space-y-3">
                    @foreach($destinations ?? App\Models\Destination::active()->ordered()->take(6)->get() as $destination)
                        <li>
                            <a href="{{ route('destinations.show', $destination->slug) }}" class="text-gray-300 hover:text-accent-400 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                {{ $destination->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-heading font-semibold mb-6">{{ __('messages.quick_links') }}</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ url('/about-us') }}" class="text-gray-300 hover:text-accent-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            {{ __('navigation.about') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tours.index') }}" class="text-gray-300 hover:text-accent-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            {{ __('navigation.tours') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-accent-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            {{ __('navigation.blog') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/mice') }}" class="text-gray-300 hover:text-accent-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            {{ __('navigation.mice') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-300 hover:text-accent-400 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            {{ __('navigation.contact') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-heading font-semibold mb-6">{{ __('messages.newsletter_title') }}</h3>
                <p class="text-gray-300 mb-4">{{ __('messages.newsletter_desc') }}</p>
                <livewire:newsletter-form />

                <!-- Social Links -->
                <div class="mt-8">
                    <h4 class="text-sm font-semibold mb-4 uppercase tracking-wider">{{ __('messages.follow_us') }}</h4>
                    <div class="flex gap-3">
                        <a href="{{ App\Models\Setting::get('facebook_url', '#') }}" target="_blank" rel="noopener" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </a>
                        <a href="{{ App\Models\Setting::get('instagram_url', '#') }}" target="_blank" rel="noopener" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="{{ App\Models\Setting::get('youtube_url', '#') }}" target="_blank" rel="noopener" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="{{ App\Models\Setting::get('linkedin_url', '#') }}" target="_blank" rel="noopener" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent-500 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white/10">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} Victoria Tour. {{ __('messages.all_rights_reserved') }}
                </p>
                <div class="flex items-center gap-6 text-sm text-gray-400">
                    <a href="{{ url('/privacy-policy') }}" class="hover:text-accent-400 transition">{{ __('navigation.privacy_policy') }}</a>
                    <a href="{{ url('/terms-of-service') }}" class="hover:text-accent-400 transition">{{ __('navigation.terms_of_service') }}</a>
                </div>
            </div>
        </div>
    </div>
</footer>
