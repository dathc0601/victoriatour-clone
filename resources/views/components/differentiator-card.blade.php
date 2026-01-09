@props(['differentiator'])

<div class="differentiator-card group cursor-pointer" data-aos="fade-up">
    <!-- Card with hover background -->
    <div class="relative px-4 py-5 rounded-xl transition-all duration-500 ease-out
                group-hover:bg-gradient-to-br group-hover:from-amber-400 group-hover:to-amber-500
                group-hover:shadow-lg group-hover:shadow-amber-500/20
                group-hover:-translate-y-1">

        <!-- Icon with circular background -->
        <div class="relative w-14 h-14 mx-auto mb-3">
            <!-- Background circle - changes color on hover -->
            <div class="absolute inset-0 rounded-full transition-all duration-500
                        bg-amber-100 group-hover:bg-primary-800"></div>
            <!-- Icon -->
            <div class="relative w-full h-full flex items-center justify-center
                        text-amber-500 group-hover:text-amber-400
                        transition-all duration-500
                        group-hover:scale-110">
                @if($differentiator->icon)
                    @svg($differentiator->icon, 'w-7 h-7')
                @else
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
                    </svg>
                @endif
            </div>
        </div>

        <!-- Title -->
        <h3 class="text-gray-800 group-hover:text-primary-900 font-semibold text-sm text-center
                   leading-snug transition-colors duration-300">
            {{ $differentiator->title }}
        </h3>

        <!-- Detail link - appears on hover -->
        <div class="mt-2 text-center overflow-hidden">
            <span class="inline-flex items-center gap-1 text-xs font-medium text-primary-800
                        opacity-0 translate-y-3 group-hover:opacity-100 group-hover:translate-y-0
                        transition-all duration-500 delay-100">
                {{ __('messages.home.detail') }}
                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </span>
        </div>
    </div>
</div>
