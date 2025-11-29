<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    public function definition(): array
    {
        $name = fake()->country();
        return [
            'name' => ['en' => $name, 'vi' => $name],
            'slug' => fake()->unique()->slug(),
            'description' => ['en' => fake()->paragraphs(2, true), 'vi' => fake()->paragraphs(2, true)],
            'image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/800/600',
            'meta_title' => ['en' => "Tours in {$name}", 'vi' => "Du lịch {$name}"],
            'meta_description' => ['en' => fake()->sentence(), 'vi' => fake()->sentence()],
            'is_featured' => fake()->boolean(30),
            'order' => fake()->numberBetween(0, 20),
            'is_active' => true,
        ];
    }
}
