<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $title = fake()->sentence(6);
        return [
            'blog_category_id' => BlogCategory::factory(),
            'title' => ['en' => $title, 'vi' => $title],
            'slug' => fake()->unique()->slug(),
            'excerpt' => ['en' => fake()->paragraph(), 'vi' => fake()->paragraph()],
            'content' => ['en' => fake()->paragraphs(6, true), 'vi' => fake()->paragraphs(6, true)],
            'image' => 'https://picsum.photos/seed/' . fake()->uuid() . '/800/600',
            'author' => fake()->name(),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'meta_title' => ['en' => $title, 'vi' => $title],
            'meta_description' => ['en' => fake()->sentence(), 'vi' => fake()->sentence()],
            'is_featured' => fake()->boolean(20),
            'is_active' => true,
        ];
    }
}
