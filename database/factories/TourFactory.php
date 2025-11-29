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
            'itinerary' => ['en' => fake()->paragraphs(5, true), 'vi' => fake()->paragraphs(5, true)],
            'inclusions' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'exclusions' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'meta_title' => ['en' => $title, 'vi' => $title],
            'meta_description' => ['en' => fake()->sentence(), 'vi' => fake()->sentence()],
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
            'order' => fake()->numberBetween(0, 50),
        ];
    }
}
