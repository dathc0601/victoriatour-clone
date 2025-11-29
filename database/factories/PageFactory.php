<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        $title = fake()->sentence(3);
        return [
            'title' => ['en' => $title, 'vi' => $title],
            'slug' => fake()->unique()->slug(),
            'content' => ['en' => fake()->paragraphs(5, true), 'vi' => fake()->paragraphs(5, true)],
            'meta_title' => ['en' => $title, 'vi' => $title],
            'meta_description' => ['en' => fake()->sentence(), 'vi' => fake()->sentence()],
            'template' => 'default',
            'is_active' => true,
        ];
    }
}
