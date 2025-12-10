<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    protected $model = Tour::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);
        $durationDays = fake()->numberBetween(1, 14);

        return [
            'destination_id' => Destination::factory(),
            'city_id' => null,
            'title' => ['en' => $title, 'vi' => $title],
            'slug' => fake()->unique()->slug(),
            'excerpt' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'description' => ['en' => fake()->paragraphs(3, true), 'vi' => fake()->paragraphs(3, true)],
            'duration_days' => $durationDays,
            'price' => fake()->randomElement([null, fake()->numberBetween(500, 5000)]),
            'price_type' => fake()->randomElement(['fixed', 'from', 'contact']),
            'rating' => fake()->randomFloat(1, 4, 5),
            'gallery' => [
                'https://picsum.photos/seed/' . fake()->uuid() . '/800/600',
                'https://picsum.photos/seed/' . fake()->uuid() . '/800/600',
                'https://picsum.photos/seed/' . fake()->uuid() . '/800/600',
            ],
            'itinerary' => [
                'en' => $this->generateItinerary($durationDays, 'en'),
                'vi' => $this->generateItinerary($durationDays, 'vi'),
            ],
            'inclusions' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'exclusions' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'meta_title' => ['en' => $title, 'vi' => $title],
            'meta_description' => ['en' => fake()->sentence(), 'vi' => fake()->sentence()],
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
            'order' => fake()->numberBetween(0, 50),
        ];
    }

    /**
     * Generate structured itinerary data for the tour
     */
    private function generateItinerary(int $days, string $locale = 'en'): array
    {
        $itinerary = [];
        $activities = $locale === 'en'
            ? ['City Tour', 'Temple Visit', 'Local Market', 'Beach Day', 'Mountain Hiking', 'Cultural Show', 'Cooking Class', 'Boat Trip', 'Museum Visit', 'Shopping']
            : ['Tham quan thành phố', 'Viếng đền chùa', 'Chợ địa phương', 'Ngày biển', 'Leo núi', 'Biểu diễn văn hóa', 'Lớp nấu ăn', 'Du thuyền', 'Tham quan bảo tàng', 'Mua sắm'];

        $locations = $locale === 'en'
            ? ['Downtown', 'Old Quarter', 'Beach Area', 'Mountain Region', 'Cultural District', 'Harbor', 'Countryside']
            : ['Trung tâm', 'Phố cổ', 'Khu vực biển', 'Vùng núi', 'Khu văn hóa', 'Cảng', 'Nông thôn'];

        for ($i = 1; $i <= $days; $i++) {
            $dayTitle = $locale === 'en'
                ? fake()->randomElement(['Arrival and', 'Exploring', 'Adventure in', 'Discovering', 'Day at']) . ' ' . fake()->randomElement($locations)
                : fake()->randomElement(['Đến và', 'Khám phá', 'Phiêu lưu tại', 'Tìm hiểu', 'Ngày tại']) . ' ' . fake()->randomElement($locations);

            $highlights = fake()->randomElements($activities, fake()->numberBetween(2, 4));
            $meals = fake()->randomElements(['Breakfast', 'Lunch', 'Dinner'], fake()->numberBetween(1, 3));

            $itinerary[] = [
                'title' => $dayTitle,
                'location' => fake()->randomElement($locations),
                'description' => fake()->paragraph(2),
                'highlights' => $highlights,
                'meals' => $meals,
            ];
        }

        return $itinerary;
    }
}
