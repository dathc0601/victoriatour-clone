<div>
    @if($success)
        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-lg" data-aos="fade-up">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h4 class="font-semibold">Message Sent Successfully!</h4>
                    <p class="text-sm">Thank you for contacting us. We'll get back to you within 24 hours.</p>
                </div>
            </div>
        </div>
    @else
        <form wire:submit="submit" class="space-y-6">
            <!-- Honeypot field (hidden from users) -->
            <div class="hidden" aria-hidden="true">
                <input type="text" wire:model="honeypot" tabindex="-1" autocomplete="off">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        placeholder="John Doe"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('name') border-red-500 @enderror"
                    >
                    @error('name')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input
                        type="email"
                        id="email"
                        wire:model="email"
                        placeholder="john@example.com"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    wire:model="phone"
                    placeholder="+84 123 456 789"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                >
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Message *</label>
                <textarea
                    id="message"
                    wire:model="message"
                    rows="5"
                    placeholder="Tell us about your travel plans..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition resize-none @error('message') border-red-500 @enderror"
                ></textarea>
                @error('message')
                    <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full md:w-auto px-8 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition shadow-md hover:shadow-lg disabled:opacity-50 flex items-center justify-center gap-2"
                >
                    <span wire:loading.remove>Send Message</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending...
                    </span>
                </button>
            </div>
        </form>
    @endif
</div>
