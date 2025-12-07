<div>
    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl text-green-700 dark:text-green-400 text-sm">
            {{ session('message') }}
        </div>
    @endif

    {{-- Add Column Button --}}
    <div class="flex justify-end mb-4">
        <button
            wire:click="openCreateModal"
            type="button"
            class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors"
        >
            <x-heroicon-o-plus class="w-4 h-4" />
            Add Column
        </button>
    </div>

    {{-- Columns List --}}
    <div class="space-y-3">
        @forelse($columns as $index => $column)
            <div
                wire:key="column-{{ $column['id'] }}"
                class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 {{ !$column['is_active'] ? 'opacity-50' : '' }}"
            >
                {{-- Order Number --}}
                <div class="w-8 h-8 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm font-medium text-gray-600 dark:text-gray-400">
                    {{ $index + 1 }}
                </div>

                {{-- Column Type Icon --}}
                <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/50 flex items-center justify-center flex-shrink-0">
                    @switch($column['type'])
                        @case('logo_contact')
                            <x-heroicon-o-building-office class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                            @break
                        @case('destinations')
                            <x-heroicon-o-map-pin class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                            @break
                        @case('menu_links')
                            <x-heroicon-o-link class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                            @break
                        @case('newsletter_social')
                            <x-heroicon-o-envelope class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                            @break
                        @case('custom_html')
                            <x-heroicon-o-code-bracket class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                            @break
                        @default
                            <x-heroicon-o-rectangle-stack class="w-5 h-5 text-primary-600 dark:text-primary-400" />
                    @endswitch
                </div>

                {{-- Column Info --}}
                <div class="flex-1 min-w-0">
                    <h4 class="font-medium text-gray-900 dark:text-white truncate">
                        {{ $column['title'][app()->getLocale()] ?? $column['title']['en'] ?? 'Untitled' }}
                    </h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $columnTypes[$column['type']] ?? $column['type'] }}
                        &middot; Width: {{ $column['width'] }}/4
                    </p>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    {{-- Toggle Active --}}
                    <button
                        wire:click="toggleActive({{ $column['id'] }})"
                        type="button"
                        class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        title="{{ $column['is_active'] ? 'Deactivate' : 'Activate' }}"
                    >
                        @if($column['is_active'])
                            <x-heroicon-o-eye class="w-5 h-5" />
                        @else
                            <x-heroicon-o-eye-slash class="w-5 h-5" />
                        @endif
                    </button>

                    {{-- Edit --}}
                    <button
                        wire:click="openEditModal({{ $column['id'] }})"
                        type="button"
                        class="p-2 text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        title="Edit"
                    >
                        <x-heroicon-o-pencil class="w-5 h-5" />
                    </button>

                    {{-- Delete --}}
                    <button
                        wire:click="deleteColumn({{ $column['id'] }})"
                        wire:confirm="Are you sure you want to delete this column?"
                        type="button"
                        class="p-2 text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
                        title="Delete"
                    >
                        <x-heroicon-o-trash class="w-5 h-5" />
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                <x-heroicon-o-view-columns class="w-12 h-12 mx-auto mb-3 opacity-50" />
                <p class="font-medium">No columns configured yet.</p>
                <p class="text-sm mt-1">Click "Add Column" to get started.</p>
            </div>
        @endforelse
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

                {{-- Modal panel --}}
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $isEditing ? 'Edit Footer Column' : 'Add Footer Column' }}
                        </h3>
                    </div>

                    <div class="px-6 py-5 space-y-4">
                        {{-- Title Fields --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Title (English) *
                                </label>
                                <input
                                    type="text"
                                    wire:model="formData.title_en"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                />
                                @error('formData.title_en')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Title (Vietnamese)
                                </label>
                                <input
                                    type="text"
                                    wire:model="formData.title_vi"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500"
                                />
                            </div>
                        </div>

                        {{-- Column Type --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Content Type *
                            </label>
                            <select
                                wire:model.live="formData.type"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500"
                            >
                                @foreach($columnTypes as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Column Width --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Column Width
                            </label>
                            <select
                                wire:model="formData.width"
                                class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500"
                            >
                                <option value="1">1/4 (Small)</option>
                                <option value="2">2/4 (Medium)</option>
                                <option value="3">3/4 (Large)</option>
                                <option value="4">4/4 (Full Width)</option>
                            </select>
                        </div>

                        {{-- Type-Specific Settings: Custom HTML --}}
                        @if($formData['type'] === 'custom_html')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Custom HTML (English)
                                </label>
                                <textarea
                                    wire:model="formData.settings.html_en"
                                    rows="4"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500 font-mono text-sm"
                                    placeholder="<p>Your custom HTML content...</p>"
                                ></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Custom HTML (Vietnamese)
                                </label>
                                <textarea
                                    wire:model="formData.settings.html_vi"
                                    rows="4"
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500 font-mono text-sm"
                                    placeholder="<p>Nội dung HTML tùy chỉnh...</p>"
                                ></textarea>
                            </div>
                        @endif

                        {{-- Active Toggle --}}
                        <div class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                wire:model="formData.is_active"
                                id="is_active"
                                class="rounded border-gray-300 dark:border-gray-600 text-primary-600 focus:ring-primary-500"
                            />
                            <label for="is_active" class="text-sm text-gray-700 dark:text-gray-300">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 flex justify-end gap-3">
                        <button
                            wire:click="closeModal"
                            type="button"
                            class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                        >
                            Cancel
                        </button>
                        <button
                            wire:click="saveColumn"
                            type="button"
                            class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors"
                        >
                            {{ $isEditing ? 'Save Changes' : 'Create Column' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
