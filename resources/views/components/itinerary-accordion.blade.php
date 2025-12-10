@props([
    'itinerary' => null,
    'duration' => 1
])

@php
    // Determine if itinerary is structured JSON or plain text
    $isStructured = false;
    $days = [];

    if ($itinerary) {
        // Check if it's already an array (structured JSON)
        if (is_array($itinerary)) {
            $isStructured = true;
            $days = $itinerary;
        }
        // Check if it's a JSON string
        elseif (is_string($itinerary)) {
            // Check if it starts with [ which indicates JSON array
            $trimmed = trim($itinerary);
            if (str_starts_with($trimmed, '[')) {
                // Clean the string - remove any HTML entities
                $cleanItinerary = html_entity_decode($itinerary, ENT_QUOTES, 'UTF-8');

                // Try to decode the JSON string
                $decoded = json_decode($cleanItinerary, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    // Check if it's an array of day objects (has 'day' or 'title' keys)
                    if (!empty($decoded) && (isset($decoded[0]['day']) || isset($decoded[0]['title']))) {
                        $isStructured = true;
                        $days = $decoded;
                    }
                }
            }
        }
    }
@endphp

@if($itinerary)
    @if($isStructured && count($days) > 0)
        <!-- Structured Accordion -->
        <div x-data="{ openDay: 0 }" class="space-y-4">
            @foreach($days as $index => $day)
                <div class="border border-gray-200 rounded-xl overflow-hidden bg-white transition-shadow hover:shadow-md">
                    <!-- Day Header -->
                    <button
                        @click="openDay = openDay === {{ $index }} ? null : {{ $index }}"
                        class="w-full px-6 py-4 flex items-center gap-4 text-left hover:bg-gray-50 transition"
                        :class="openDay === {{ $index }} ? 'bg-primary-50' : ''"
                    >
                        <!-- Day Badge -->
                        <div class="flex-shrink-0 w-16 h-16 bg-primary-500 text-white rounded-xl flex flex-col items-center justify-center"
                             :class="openDay === {{ $index }} ? 'bg-accent-500' : 'bg-primary-500'">
                            <span class="text-xs uppercase font-medium">Day</span>
                            <span class="text-2xl font-bold">{{ $day['day'] ?? $index + 1 }}</span>
                        </div>

                        <!-- Title -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 truncate">
                                {{ $day['title'] ?? 'Day ' . ($index + 1) }}
                            </h3>
                            @if(isset($day['location']))
                                <p class="text-sm text-gray-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    {{ $day['location'] }}
                                </p>
                            @endif
                        </div>

                        <!-- Expand Icon -->
                        <svg
                            class="w-6 h-6 text-gray-400 transform transition-transform duration-200"
                            :class="openDay === {{ $index }} ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- Day Content -->
                    <div
                        x-show="openDay === {{ $index }}"
                        x-collapse
                        x-cloak
                    >
                        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                            @if(isset($day['description']))
                                <div class="prose prose-sm max-w-none text-gray-600">
                                    {!! nl2br(e($day['description'])) !!}
                                </div>
                            @endif

                            @if(isset($day['highlights']) && is_array($day['highlights']))
                                <div class="mt-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Highlights:</h4>
                                    <ul class="space-y-2">
                                        @foreach($day['highlights'] as $highlight)
                                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                                <svg class="w-5 h-5 text-accent-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ $highlight }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(isset($day['meals']) && !empty($day['meals']))
                                @php
                                    // Handle meals as array (from checkboxes) or string (legacy)
                                    $mealsDisplay = is_array($day['meals'])
                                        ? implode(', ', $day['meals'])
                                        : $day['meals'];
                                @endphp
                                <div class="mt-4 flex items-center gap-4 text-sm text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Meals: {{ $mealsDisplay }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Expand All / Collapse All -->
        <div class="mt-4 flex justify-end">
            <button
                x-data
                @click="openDay = openDay === 'all' ? null : 'all'; $dispatch('toggle-all-days', { expand: openDay === 'all' })"
                class="text-sm text-primary-500 hover:text-primary-600 font-medium"
            >
                Expand All Days
            </button>
        </div>
    @else
        <!-- Plain Text Fallback with Timeline Style -->
        <div class="relative pl-8 border-l-2 border-primary-200">
            @php
                // Try to split by paragraphs or numbered patterns
                $paragraphs = preg_split('/\n\n+/', $itinerary);
                if (count($paragraphs) <= 1) {
                    $paragraphs = preg_split('/(?=Day\s*\d)/i', $itinerary);
                }
                $paragraphs = array_filter($paragraphs);
            @endphp

            @if(count($paragraphs) > 1)
                @foreach($paragraphs as $index => $paragraph)
                    <div class="relative mb-8 last:mb-0">
                        <!-- Timeline Dot -->
                        <div class="absolute -left-[25px] w-4 h-4 bg-primary-500 rounded-full border-2 border-white shadow"></div>

                        <!-- Day Badge -->
                        <div class="inline-flex items-center gap-2 mb-2">
                            <span class="px-3 py-1 bg-primary-100 text-primary-700 text-sm font-semibold rounded-full">
                                Day {{ $index + 1 }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-100">
                            <div class="prose prose-sm max-w-none text-gray-600">
                                {!! nl2br(e(trim($paragraph))) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Single Block -->
                <div class="prose prose-lg max-w-none">
                    {!! $itinerary !!}
                </div>
            @endif
        </div>
    @endif
@else
    <!-- No Itinerary -->
    <div class="text-center py-8 text-gray-500">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <p>Detailed itinerary coming soon.</p>
        <p class="text-sm mt-2">Contact us for more information about this tour.</p>
    </div>
@endif
