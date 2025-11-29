<div>
    @if($success)
        <div class="bg-accent-500/20 border border-accent-500 text-accent-400 px-4 py-3 rounded-lg">
            Thanks for subscribing! You'll receive our latest updates soon.
        </div>
    @else
        <form wire:submit="subscribe" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input
                    type="email"
                    wire:model="email"
                    placeholder="Enter your email"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-accent-400 transition"
                >
                @error('email')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
                @if($error)
                    <p class="mt-1 text-yellow-400 text-sm">{{ $error }}</p>
                @endif
            </div>
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="px-6 py-3 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition disabled:opacity-50 whitespace-nowrap"
            >
                <span wire:loading.remove>Subscribe</span>
                <span wire:loading>Subscribing...</span>
            </button>
        </form>
    @endif
</div>
