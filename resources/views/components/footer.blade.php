<footer class="bg-[#17233e] text-white relative">
    @php
        $columns = \App\Models\FooterColumn::getCachedColumns();
        $copyrightText = \App\Models\Setting::get('footer_copyright_text', [
            'en' => 'TheSinhTour General Trading and Tourism Co., Ltd. All Rights Reserved.',
            'vi' => 'Công ty TNHH TheSinhTour. Bản quyền thuộc về TheSinhTour.',
        ]);
        $copyright = is_array($copyrightText) ? ($copyrightText[app()->getLocale()] ?? $copyrightText['en'] ?? '') : $copyrightText;
    @endphp

    <!-- Main Footer Content -->
    <div class="relative container mx-auto px-4 py-12 lg:py-16 z-20">
        @if($columns->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
                @foreach($columns as $column)
                    <div class="lg:col-span-{{ $column->width }}">
                        @includeIf('components.footer.column-' . $column->type, ['column' => $column])
                    </div>
                @endforeach
            </div>
        @else
            {{-- Fallback: Show default footer structure if no columns configured --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
                {{-- Column 1: Logo & Company Info --}}
                <div class="space-y-4">
                    @php
                        $footerLogo = \App\Models\Setting::get('footer_logo');
                    @endphp
                    <a href="{{ route('home') }}" class="inline-block group">
                        @if($footerLogo)
                            <img src="{{ Storage::url($footerLogo) }}" alt="{{ config('app.name') }}" class="h-10">
                        @else
                            <span class="text-2xl font-serif italic text-amber-400 tracking-wide">Victoria</span>
                            <span class="text-xl font-sans font-light text-white ml-0.5">Tour</span>
                        @endif
                    </a>
                    @php
                        $companyName = \App\Models\Setting::get('footer_company_name', [
                            'en' => 'TheSinhTour COMPANY LIMITED',
                            'vi' => 'CÔNG TY TNHH TheSinhTour',
                        ]);
                        $companyNameDisplay = is_array($companyName) ? ($companyName[app()->getLocale()] ?? $companyName['en'] ?? '') : $companyName;
                    @endphp
                    <h2 class="text-base font-medium tracking-wide pt-2">
                        {{ $companyNameDisplay }}
                    </h2>
                    <div class="space-y-1.5 text-sm text-gray-300 font-light leading-relaxed">
                        <p>{{ \App\Models\Setting::get('contact_address', ['en' => 'No. 29, Pham Van Bach Street'])[app()->getLocale()] ?? '' }}</p>
                        <p>{{ __('messages.footer.phone_label') }}: {{ \App\Models\Setting::get('contact_phone', '+84 85 692 9229') }}</p>
                        <p>{{ __('messages.footer.email_label') }}: {{ \App\Models\Setting::get('contact_email', 'sale20@victoriatour.com.vn') }}</p>
                    </div>
                </div>

                {{-- Column 2: Destinations --}}
                <div>
                    <h3 class="text-base font-medium mb-5">{{ __('messages.footer.destinations') }}</h3>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-2.5 text-sm text-gray-300 font-light">
                        @foreach(\App\Models\Destination::active()->ordered()->take(10)->get() as $destination)
                            <a href="{{ route('destinations.show', $destination->slug) }}"
                               class="hover:text-white transition-colors duration-200">
                                {{ $destination->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Column 3: Company Links --}}
                <div>
                    <h3 class="text-base font-medium mb-5">{{ __('messages.footer.company') }}</h3>
                    <ul class="space-y-2.5 text-sm text-gray-300 font-light">
                        @foreach(navigation('footer') as $item)
                            <li>
                                <a href="{{ menu_url($item) }}" class="hover:text-white transition-colors duration-200">
                                    {{ $item->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Column 4: Newsletter & Social --}}
                <div>
                    <h3 class="text-base font-medium mb-3">{{ __('messages.footer.newsletter_title') }}</h3>
                    <p class="text-sm text-gray-300 font-light mb-5 leading-relaxed">
                        {{ __('messages.footer.newsletter_desc') }}
                    </p>
                    <livewire:newsletter-form />
                    <div class="flex items-center gap-4 mt-6">
                        @foreach(['facebook', 'twitter', 'instagram', 'youtube', 'tiktok'] as $social)
                            @php $url = \App\Models\Setting::get($social . '_url', '#'); @endphp
                            @if($url && $url !== '#')
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                                   class="text-white/70 hover:text-white transition-colors duration-200"
                                   aria-label="{{ ucfirst($social) }}">
                                    <span class="w-4 h-4 block">{{ $social[0] }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Copyright Bar -->
    <div class="relative border-t border-white/10 z-20">
        <div class="container mx-auto px-4 py-4">
            <p class="text-center text-sm text-gray-400 font-light">
                &copy; {{ date('Y') }} {{ $copyright }}
            </p>
        </div>
    </div>
</footer>
