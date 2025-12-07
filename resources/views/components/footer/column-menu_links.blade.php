@props(['column'])

@php
    $menuItems = navigation('footer');
@endphp

<div>
    <h3 class="text-base font-medium mb-5">{{ $column->title }}</h3>

    @if($menuItems->count() > 0)
        <ul class="space-y-2.5 text-sm text-gray-300 font-light">
            @foreach($menuItems as $item)
                <li>
                    <a href="{{ menu_url($item) }}"
                       target="{{ $item->target }}"
                       class="hover:text-white transition-colors duration-200">
                        {{ $item->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-sm text-gray-400 font-light">No menu items configured.</p>
    @endif
</div>
