<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('admin.widgets.quick_actions') }}
        </x-slot>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($this->getActions() as $action)
                @php
                    $colorClasses = match($action['color']) {
                        'primary' => 'bg-primary-50 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400',
                        'success' => 'bg-success-50 dark:bg-success-500/10 text-success-600 dark:text-success-400',
                        'warning' => 'bg-warning-50 dark:bg-warning-500/10 text-warning-600 dark:text-warning-400',
                        'info' => 'bg-info-50 dark:bg-info-500/10 text-info-600 dark:text-info-400',
                        'danger' => 'bg-danger-50 dark:bg-danger-500/10 text-danger-600 dark:text-danger-400',
                        default => 'bg-gray-50 dark:bg-gray-500/10 text-gray-600 dark:text-gray-400',
                    };
                @endphp
                <a
                    href="{{ $action['url'] }}"
                    class="group relative flex flex-col items-center p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:border-primary-500 dark:hover:border-primary-500 hover:shadow-md transition-all duration-200"
                >
                    <div class="flex items-center justify-center w-12 h-12 rounded-full {{ $colorClasses }} mb-3 group-hover:scale-110 transition-transform">
                        <x-dynamic-component :component="$action['icon']" class="w-6 h-6" />
                    </div>
                    <span class="text-sm font-medium text-gray-900 dark:text-white text-center">
                        {{ $action['label'] }}
                    </span>
                    <span class="text-xs text-gray-500 dark:text-gray-400 text-center mt-1">
                        {{ $action['description'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
