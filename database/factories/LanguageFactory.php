<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    public function definition(): array
    {
        return [
            'code' => fake()->unique()->languageCode(),
            'name' => fake()->country(),
            'native_name' => fake()->country(),
            'flag_icon' => null,
            'is_default' => false,
            'is_active' => true,
            'order' => fake()->numberBetween(0, 10),
        ];
    }
}
