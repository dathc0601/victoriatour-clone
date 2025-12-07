<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button type="submit">
                Save Settings
            </x-filament::button>
        </div>
    </form>

    {{-- Column Layout Manager --}}
    <div class="mt-8">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Footer Column Layout</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manage the columns displayed in your footer. Drag to reorder.
                </p>
            </div>

            <livewire:admin.footer-column-manager />
        </div>
    </div>
</x-filament-panels::page>
