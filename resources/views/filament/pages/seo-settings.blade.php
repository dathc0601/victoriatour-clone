<x-filament-panels::page>
    <div x-data="{ activeTab: 'global' }" class="space-y-6">
        {{-- Tab Navigation --}}
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10">
            <nav class="flex space-x-1 p-1" aria-label="Tabs">
                <button
                    type="button"
                    @click="activeTab = 'global'"
                    :class="{ 'bg-primary-500 text-white': activeTab === 'global', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200': activeTab !== 'global' }"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors"
                >
                    <x-heroicon-o-cog-6-tooth class="w-5 h-5" />
                    Cài đặt chung
                </button>
                <button
                    type="button"
                    @click="activeTab = 'pages'"
                    :class="{ 'bg-primary-500 text-white': activeTab === 'pages', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200': activeTab !== 'pages' }"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors"
                >
                    <x-heroicon-o-document-text class="w-5 h-5" />
                    SEO trang
                </button>
                <button
                    type="button"
                    @click="activeTab = 'redirects'"
                    :class="{ 'bg-primary-500 text-white': activeTab === 'redirects', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200': activeTab !== 'redirects' }"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg transition-colors"
                >
                    <x-heroicon-o-arrow-right-circle class="w-5 h-5" />
                    Chuyển hướng
                </button>
            </nav>
        </div>

        {{-- Tab Content --}}
        {{-- Global Settings Tab --}}
        <div x-show="activeTab === 'global'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <form wire:submit="saveGlobalSettings">
                {{ $this->form }}

                <div class="mt-6">
                    <x-filament::button type="submit">
                        Lưu cài đặt chung
                    </x-filament::button>
                </div>
            </form>
        </div>

        {{-- Page SEO Tab --}}
        <div x-show="activeTab === 'pages'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ghi đè SEO trang</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Định nghĩa metadata tùy chỉnh cho các đường dẫn URL cụ thể. Hỗ trợ ký tự đại diện (ví dụ: <code class="bg-gray-100 dark:bg-gray-800 px-1 py-0.5 rounded">/tours/*</code>).
                    </p>
                </div>

                {{ $this->table }}
            </div>
        </div>

        {{-- Redirects Tab --}}
        <div x-show="activeTab === 'redirects'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Chuyển hướng URL</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Quản lý chuyển hướng 301/302. Chuyển hướng được xử lý trước khi áp dụng ghi đè SEO.
                    </p>
                </div>

                <livewire:admin.seo-redirects-manager />
            </div>
        </div>
    </div>
</x-filament-panels::page>
