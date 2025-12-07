@props(['column'])

@php
    $selectedIds = App\Models\Setting::get('footer_selected_destinations', []);

    if (!empty($selectedIds)) {
        $destinations = App\Models\Destination::whereIn('id', $selectedIds)
            ->active()
            ->orderByRaw('FIELD(id, ' . implode(',', $selectedIds) . ')')
            ->get();
    } else {
        $destinations = collect();
    }
@endphp

<div>
    <h3 class="text-base font-medium mb-5">{{ $column->title }}</h3>

    @if($destinations->count() > 0)
        <div class="grid grid-cols-2 gap-x-6 gap-y-2.5 text-sm text-gray-300 font-light">
            @foreach($destinations as $destination)
                <a href="{{ route('destinations.show', $destination->slug) }}"
                   class="hover:text-white transition-colors duration-200">
                    {{ $destination->name }}
                </a>
            @endforeach
        </div>
    @else
        <p class="text-sm text-gray-400 font-light">No destinations selected.</p>
    @endif
</div>
