<div>
    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-400 text-sm">
            {{ session('message') }}
        </div>
    @endif

    {{-- Header with Search and Add Button --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
        {{-- Search --}}
        <div class="relative w-full sm:w-64">
            <x-heroicon-o-magnifying-glass class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" />
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Tìm kiếm chuyển hướng..."
                class="w-full pl-9 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm focus:border-primary-500 focus:ring-primary-500"
            />
        </div>

        {{-- Add Button --}}
        <button
            wire:click="openCreateModal"
            type="button"
            class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors"
        >
            <x-heroicon-o-plus class="w-4 h-4" />
            Thêm
        </button>
    </div>

    {{-- Redirects Table --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Nguồn
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Đích
                    </th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Loại
                    </th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Lượt truy cập
                    </th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Trạng thái
                    </th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($redirects as $redirect)
                    <tr wire:key="redirect-{{ $redirect->id }}" class="{{ !$redirect->is_active ? 'opacity-50' : '' }}">
                        <td class="px-4 py-3">
                            <code class="text-sm bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-gray-800 dark:text-gray-200">
                                {{ $redirect->source_path }}
                            </code>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-sm text-gray-600 dark:text-gray-400 truncate block max-w-xs" title="{{ $redirect->target_url }}">
                                {{ Str::limit($redirect->target_url, 40) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $redirect->status_code === 301 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-400' }}">
                                {{ $redirect->status_code }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400" title="Lần truy cập cuối: {{ $redirect->last_hit_at?->diffForHumans() ?? 'Chưa có' }}">
                                {{ number_format($redirect->hit_count) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button
                                wire:click="toggleActive({{ $redirect->id }})"
                                type="button"
                                class="inline-flex items-center"
                            >
                                @if($redirect->is_active)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-400">
                                        Hoạt động
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">
                                        Tắt
                                    </span>
                                @endif
                            </button>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex items-center justify-end gap-1">
                                {{-- Reset Hits --}}
                                @if($redirect->hit_count > 0)
                                    <button
                                        wire:click="resetHitCount({{ $redirect->id }})"
                                        wire:confirm="Đặt lại số lượt truy cập về 0?"
                                        type="button"
                                        class="p-1.5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded transition-colors"
                                        title="Đặt lại lượt truy cập"
                                    >
                                        <x-heroicon-o-arrow-path class="w-4 h-4" />
                                    </button>
                                @endif

                                {{-- Edit --}}
                                <button
                                    wire:click="openEditModal({{ $redirect->id }})"
                                    type="button"
                                    class="p-1.5 text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 rounded transition-colors"
                                    title="Sửa"
                                >
                                    <x-heroicon-o-pencil class="w-4 h-4" />
                                </button>

                                {{-- Delete --}}
                                <button
                                    wire:click="deleteRedirect({{ $redirect->id }})"
                                    wire:confirm="Bạn có chắc chắn muốn xóa chuyển hướng này?"
                                    type="button"
                                    class="p-1.5 text-gray-400 hover:text-red-600 dark:hover:text-red-400 rounded transition-colors"
                                    title="Xóa"
                                >
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-12 text-center">
                            <x-heroicon-o-arrow-right-circle class="w-12 h-12 mx-auto mb-3 text-gray-400 opacity-50" />
                            <p class="font-medium text-gray-500 dark:text-gray-400">Chưa có chuyển hướng nào được cấu hình.</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Nhấn "Thêm chuyển hướng" để bắt đầu.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if($redirects->hasPages())
            <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700">
                {{ $redirects->links() }}
            </div>
        @endif
    </div>

    {{-- Create/Edit Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                {{-- Background overlay --}}
                <div
                    wire:click="closeModal"
                    class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/75 transition-opacity"
                ></div>

                {{-- Centering trick --}}
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                {{-- Modal panel --}}
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $isEditing ? 'Sửa chuyển hướng' : 'Thêm chuyển hướng' }}
                        </h3>
                    </div>

                    <div class="px-6 py-5 space-y-4">
                        {{-- Source Path --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Đường dẫn nguồn *
                            </label>
                            <input
                                type="text"
                                wire:model="formData.source_path"
                                placeholder="/duong-dan-cu"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500"
                            />
                            @error('formData.source_path')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Đường dẫn URL sẽ kích hoạt chuyển hướng
                            </p>
                        </div>

                        {{-- Target URL --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                URL đích *
                            </label>
                            <input
                                type="text"
                                wire:model="formData.target_url"
                                placeholder="/duong-dan-moi hoặc https://example.com/page"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500"
                            />
                            @error('formData.target_url')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Có thể là đường dẫn tương đối hoặc URL tuyệt đối
                            </p>
                        </div>

                        {{-- Status Code --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Loại chuyển hướng
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input
                                        type="radio"
                                        wire:model="formData.status_code"
                                        value="301"
                                        class="text-primary-600 focus:ring-primary-500"
                                    />
                                    <span class="text-sm text-gray-700 dark:text-gray-300">301 (Vĩnh viễn)</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input
                                        type="radio"
                                        wire:model="formData.status_code"
                                        value="302"
                                        class="text-primary-600 focus:ring-primary-500"
                                    />
                                    <span class="text-sm text-gray-700 dark:text-gray-300">302 (Tạm thời)</span>
                                </label>
                            </div>
                        </div>

                        {{-- Active Toggle --}}
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                wire:model="formData.is_active"
                                id="redirect_is_active"
                                class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500"
                            />
                            <label for="redirect_is_active" class="text-sm text-gray-700 dark:text-gray-300">
                                Kích hoạt
                            </label>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 flex justify-end gap-3">
                        <button
                            wire:click="closeModal"
                            type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                        >
                            Hủy
                        </button>
                        <button
                            wire:click="saveRedirect"
                            type="button"
                            class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors"
                        >
                            {{ $isEditing ? 'Lưu thay đổi' : 'Tạo chuyển hướng' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
