<?php

namespace Database\Factories;

use App\Models\Differentiator;
use Illuminate\Database\Eloquent\Factories\Factory;

class DifferentiatorFactory extends Factory
{
    protected $model = Differentiator::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);
        return [
            'title' => ['en' => $title, 'vi' => $title],
            'description' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'icon' => fake()->randomElement(['heroicon-o-star', 'heroicon-o-heart', 'heroicon-o-globe-alt', 'heroicon-o-shield-check']),
            'order' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}
