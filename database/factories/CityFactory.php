<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        $name = fake()->city();
        return [
            'destination_id' => Destination::factory(),
            'name' => ['en' => $name, 'vi' => $name],
            'slug' => fake()->unique()->slug(),
            'description' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/800/600',
            'tour_count' => 0,
            'is_active' => true,
        ];
    }
}
