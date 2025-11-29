<!-- Back to Top Button -->
<div
    x-data="{ show: false }"
    x-on:scroll.window="show = window.pageYOffset > 400"
>
    <button
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-20 right-4 z-40 p-3 bg-primary-500 text-white rounded-full shadow-lg hover:bg-primary-600 hover:shadow-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:ring-offset-2"
        aria-label="Back to top"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
</div>
