<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    protected $model = Slider::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);
        return [
            'title' => ['en' => $title, 'vi' => $title],
            'subtitle' => ['en' => fake()->sentence(), 'vi' => fake()->sentence()],
            'image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/1920/800',
            'button_text' => ['en' => 'Discover More', 'vi' => 'Khám Phá'],
            'button_url' => '/destinations',
            'order' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }
}
