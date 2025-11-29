<?php

namespace Database\Factories;

use App\Models\TourCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourCategoryFactory extends Factory
{
    protected $model = TourCategory::class;

    public function definition(): array
    {
        $name = fake()->randomElement(['Adventure', 'Cultural', 'Beach', 'Food & Culinary', 'Wellness', 'Eco-Tourism', 'Luxury', 'Budget']);
        return [
            'name' => ['en' => $name, 'vi' => $name],
            'slug' => fake()->unique()->slug(),
            'is_active' => true,
        ];
    }
}
