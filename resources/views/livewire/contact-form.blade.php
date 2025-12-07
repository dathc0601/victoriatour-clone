<div>
    @if($success)
        {{-- Success Message with Animation --}}
        <div class="text-center py-12">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-green-400 to-green-500 flex items-center justify-center contact-success-checkmark shadow-lg shadow-green-500/30">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-3">
                {{ __('messages.contact_page.success_title') }}
            </h3>
            <p class="text-gray-600 max-w-md mx-auto">
                {{ __('messages.contact_page.success_message') }}
            </p>
        </div>
    @else
        <form wire:submit="submit" class="space-y-6">
            {{-- Honeypot field (hidden from users) --}}
            <div class="hidden" aria-hidden="true">
                <input type="text" wire:model="honeypot" tabindex="-1" autocomplete="off">
            </div>

            {{-- Name and Email Row --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('messages.contact_page.form_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        placeholder="{{ __('messages.contact_page.form_name_placeholder') }}"
                        class="w-full @error('name') !border-red-400 !bg-red-50 @enderror"
                    >
                    @error('name')
                        <p class="mt-2 text-red-500 text-sm flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('messages.contact_page.form_email') }} <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        wire:model="email"
                        placeholder="{{ __('messages.contact_page.form_email_placeholder') }}"
                        class="w-full @error('email') !border-red-400 !bg-red-50 @enderror"
                    >
                    @error('email')
                        <p class="mt-2 text-red-500 text-sm flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- Phone --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('messages.contact_page.form_phone') }}
                    <span class="text-gray-400 font-normal">{{ __('messages.contact_page.form_phone_optional') }}</span>
                </label>
                <input
                    type="tel"
                    id="phone"
                    wire:model="phone"
                    placeholder="{{ __('messages.contact_page.form_phone_placeholder') }}"
                    class="w-full"
                >
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('messages.contact_page.form_message') }} <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="message"
                    wire:model="message"
                    rows="5"
                    placeholder="{{ __('messages.contact_page.form_message_placeholder') }}"
                    class="w-full resize-none @error('message') !border-red-400 !bg-red-50 @enderror"
                ></textarea>
                @error('message')
                    <p class="mt-2 text-red-500 text-sm flex items-center gap-1.5">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="pt-4">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="contact-submit-button w-full md:w-auto flex items-center justify-center gap-3"
                >
                    <span wire:loading.remove wire:target="submit">
                        {{ __('messages.contact_page.form_submit') }}
                    </span>
                    <span wire:loading wire:target="submit" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ __('messages.contact_page.form_sending') }}
                    </span>
                    <svg wire:loading.remove wire:target="submit" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </form>
    @endif
</div>
