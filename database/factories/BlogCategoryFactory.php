<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCategoryFactory extends Factory
{
    protected $model = BlogCategory::class;

    public function definition(): array
    {
        $name = fake()->randomElement(['Travel Tips', 'Destinations', 'Culture', 'Food', 'Adventure', 'Photography']);
        return [
            'name' => ['en' => $name, 'vi' => $name],
            'slug' => fake()->unique()->slug(),
            'is_active' => true,
        ];
    }
}
