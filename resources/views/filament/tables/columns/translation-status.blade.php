@php
    $record = $getRecord();
    $sourceLocale = $record->source_locale ?? 'en';
    $languages = \App\Models\Language::active()->where('code', '!=', $sourceLocale)->get();

    // Check if model has auto-translation trait
    $hasAutoTranslation = method_exists($record, 'getTranslationStatus');
@endphp

<div class="flex items-center gap-1.5">
    {{-- Source language indicator --}}
    <span title="Source: {{ $sourceLocale }}"
          class="inline-flex items-center justify-center px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide bg-gray-100 text-gray-600 ring-1 ring-gray-200">
        {{ strtoupper($sourceLocale) }}
        <svg class="w-2.5 h-2.5 ml-0.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
    </span>

    {{-- Target language statuses --}}
    @foreach($languages as $language)
        @php
            $status = $record->getTranslationStatus($language->code);
            $statusConfig = match($status) {
                'completed' => [
                    'bg' => 'bg-emerald-50',
                    'text' => 'text-emerald-700',
                    'ring' => 'ring-emerald-200',
                    'icon' => '<svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>',
                    'label' => 'Completed',
                ],
                'in_progress' => [
                    'bg' => 'bg-blue-50',
                    'text' => 'text-blue-700',
                    'ring' => 'ring-blue-200',
                    'icon' => '<svg class="w-2.5 h-2.5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>',
                    'label' => 'In Progress',
                ],
                'pending' => [
                    'bg' => 'bg-amber-50',
                    'text' => 'text-amber-700',
                    'ring' => 'ring-amber-200',
                    'icon' => '<svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>',
                    'label' => 'Pending',
                ],
                'failed' => [
                    'bg' => 'bg-red-50',
                    'text' => 'text-red-700',
                    'ring' => 'ring-red-200',
                    'icon' => '<svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>',
                    'label' => 'Failed',
                ],
                default => [
                    'bg' => 'bg-gray-50',
                    'text' => 'text-gray-400',
                    'ring' => 'ring-gray-200',
                    'icon' => '<svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/></svg>',
                    'label' => 'Not started',
                ],
            };
        @endphp

        <span title="{{ $language->name }}: {{ $statusConfig['label'] }}"
              class="inline-flex items-center gap-1 px-2 py-1 rounded text-[10px] font-bold uppercase tracking-wide {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} ring-1 {{ $statusConfig['ring'] }}">
            {!! $statusConfig['icon'] !!}
            {{ strtoupper($language->code) }}
        </span>
    @endforeach
</div>
