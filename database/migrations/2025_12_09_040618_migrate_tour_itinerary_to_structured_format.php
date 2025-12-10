<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Converts plain text itinerary to structured day-by-day format
     */
    public function up(): void
    {
        $tours = DB::table('tours')->whereNotNull('itinerary')->get();

        foreach ($tours as $tour) {
            $itinerary = json_decode($tour->itinerary, true);

            if (!$itinerary) {
                continue;
            }

            $newItinerary = [];

            foreach (['en', 'vi'] as $locale) {
                if (!isset($itinerary[$locale])) {
                    continue;
                }

                $content = $itinerary[$locale];

                // Skip if already structured (array of objects)
                if (is_array($content) && isset($content[0]) && is_array($content[0])) {
                    $newItinerary[$locale] = $content;
                    continue;
                }

                // Convert plain text to structured format
                if (is_string($content)) {
                    $newItinerary[$locale] = $this->parseTextToStructured($content, $tour->duration_days ?? 1);
                } else {
                    $newItinerary[$locale] = [];
                }
            }

            if (!empty($newItinerary)) {
                DB::table('tours')
                    ->where('id', $tour->id)
                    ->update(['itinerary' => json_encode($newItinerary)]);
            }
        }
    }

    /**
     * Parse plain text itinerary into structured format
     */
    private function parseTextToStructured(string $text, int $durationDays = 1): array
    {
        $structured = [];

        // Clean up HTML and get plain text
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');

        // Try to split by "Day X" patterns
        $dayPattern = '/(?:Day\s*(\d+)[:\.\s]*|Ngày\s*(\d+)[:\.\s]*)/i';

        if (preg_match_all($dayPattern, $text, $matches, PREG_OFFSET_CAPTURE)) {
            // Found day patterns, split by them
            $parts = preg_split($dayPattern, $text, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($parts as $index => $part) {
                $part = trim($part);
                if (empty($part)) {
                    continue;
                }

                // Extract first line as potential title
                $lines = explode("\n", $part);
                $title = trim($lines[0] ?? '');
                $description = trim(implode("\n", array_slice($lines, 1)));

                if (empty($description)) {
                    $description = $title;
                    $title = '';
                }

                $structured[] = [
                    'title' => $title ?: 'Day ' . (count($structured) + 1),
                    'location' => '',
                    'description' => $description,
                    'highlights' => [],
                    'meals' => [],
                ];
            }
        } else {
            // No day patterns found, split by paragraphs
            $paragraphs = preg_split('/\n\n+/', $text);
            $paragraphs = array_filter($paragraphs, fn($p) => !empty(trim($p)));

            if (count($paragraphs) > 0) {
                // Distribute paragraphs across days
                $paragraphsPerDay = max(1, ceil(count($paragraphs) / $durationDays));

                for ($day = 0; $day < $durationDays; $day++) {
                    $startIndex = $day * $paragraphsPerDay;
                    $dayParagraphs = array_slice($paragraphs, $startIndex, $paragraphsPerDay);

                    if (empty($dayParagraphs)) {
                        break;
                    }

                    $structured[] = [
                        'title' => 'Day ' . ($day + 1),
                        'location' => '',
                        'description' => trim(implode("\n\n", $dayParagraphs)),
                        'highlights' => [],
                        'meals' => [],
                    ];
                }
            }
        }

        // If still empty, create a single day with all content
        if (empty($structured) && !empty(trim($text))) {
            $structured[] = [
                'title' => 'Day 1',
                'location' => '',
                'description' => trim($text),
                'highlights' => [],
                'meals' => [],
            ];
        }

        return $structured;
    }

    /**
     * Reverse the migrations.
     * Note: This is a destructive operation - structured data will be converted back to plain text
     */
    public function down(): void
    {
        $tours = DB::table('tours')->whereNotNull('itinerary')->get();

        foreach ($tours as $tour) {
            $itinerary = json_decode($tour->itinerary, true);

            if (!$itinerary) {
                continue;
            }

            $textItinerary = [];

            foreach (['en', 'vi'] as $locale) {
                if (!isset($itinerary[$locale]) || !is_array($itinerary[$locale])) {
                    continue;
                }

                $parts = [];
                foreach ($itinerary[$locale] as $index => $day) {
                    if (is_array($day)) {
                        $dayText = 'Day ' . ($index + 1);
                        if (!empty($day['title'])) {
                            $dayText .= ': ' . $day['title'];
                        }
                        $dayText .= "\n";
                        if (!empty($day['description'])) {
                            $dayText .= $day['description'];
                        }
                        $parts[] = $dayText;
                    }
                }

                $textItinerary[$locale] = implode("\n\n", $parts);
            }

            if (!empty($textItinerary)) {
                DB::table('tours')
                    ->where('id', $tour->id)
                    ->update(['itinerary' => json_encode($textItinerary)]);
            }
        }
    }
};
