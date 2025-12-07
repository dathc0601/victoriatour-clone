<div>
    @if($success)
        <div class="bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 px-4 py-3 rounded text-sm">
            {{ __('messages.home.newsletter_success') }}
        </div>
    @else
        <form wire:submit="subscribe" class="relative">
            <input
                type="email"
                wire:model="email"
                placeholder="{{ __('messages.footer.enter_email') }}"
                class="w-full pl-4 pr-12 py-3 bg-transparent border border-white/30 text-white text-sm placeholder-gray-400 focus:outline-none focus:border-white/50 transition-colors"
            >
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="absolute right-0 top-0 h-full px-4 text-white/60 hover:text-white transition-colors disabled:opacity-50"
                aria-label="{{ __('buttons.subscribe') }}"
            >
                <svg wire:loading.remove class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                </svg>
                <svg wire:loading class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </button>
        </form>
        @error('email')
            <p class="mt-2 text-red-400 text-xs">{{ $message }}</p>
        @enderror
        @if($error)
            <p class="mt-2 text-amber-400 text-xs">{{ $error }}</p>
        @endif
    @endif
</div>
