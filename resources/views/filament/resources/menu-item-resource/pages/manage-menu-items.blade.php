<x-filament-panels::page class="filament-tree-page">
    {{-- Tree Component --}}
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 p-6">
        <div class="mb-4 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Header Navigation
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Drag items to reorder. Maximum 3 levels deep.
                </p>
            </div>
        </div>

        {{ $this->tree }}
    </div>

    {{-- Help Section --}}
    <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700">
        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quick Tips</h4>
        <ul class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
            <li class="flex items-center gap-2">
                <x-heroicon-o-arrows-up-down class="w-3.5 h-3.5" />
                Drag items to reorder or nest them under parent items
            </li>
            <li class="flex items-center gap-2">
                <x-heroicon-o-pencil-square class="w-3.5 h-3.5" />
                Click the edit icon to modify an item
            </li>
            <li class="flex items-center gap-2">
                <x-heroicon-o-plus class="w-3.5 h-3.5" />
                Use the "New menu item" button to add items
            </li>
        </ul>
    </div>
</x-filament-panels::page>
