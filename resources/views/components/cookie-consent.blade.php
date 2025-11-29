<div
    x-data="{
        show: false,
        init() {
            if (!localStorage.getItem('cookieConsent')) {
                setTimeout(() => this.show = true, 1000);
            }
        },
        accept() {
            localStorage.setItem('cookieConsent', 'accepted');
            this.show = false;
        },
        decline() {
            localStorage.setItem('cookieConsent', 'declined');
            this.show = false;
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    x-cloak
    class="fixed bottom-0 inset-x-0 z-50 p-4"
>
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-2xl border border-gray-200 p-4 md:p-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <!-- Content -->
                <div class="flex items-start gap-4 flex-1">
                    <div class="flex-shrink-0 w-10 h-10 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">{{ __('messages.cookie_title') }}</h3>
                        <p class="text-sm text-gray-600">
                            {{ __('messages.cookie_message') }}
                            @php
                                $privacyPage = \App\Models\Page::where('slug', 'privacy-policy')->first();
                            @endphp
                            @if($privacyPage)
                                <a href="{{ route('pages.show', $privacyPage->slug) }}" class="text-primary-500 hover:underline">
                                    {{ __('buttons.learn_more') }}
                                </a>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3 flex-shrink-0">
                    <button
                        @click="decline()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition"
                    >
                        {{ __('buttons.decline') }}
                    </button>
                    <button
                        @click="accept()"
                        class="px-6 py-2 bg-primary-500 text-white text-sm font-medium rounded-lg hover:bg-primary-600 transition shadow-sm"
                    >
                        {{ __('buttons.accept') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
