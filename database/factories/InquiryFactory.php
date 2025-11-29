<?php

namespace Database\Factories;

use App\Models\Inquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

class InquiryFactory extends Factory
{
    protected $model = Inquiry::class;

    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['contact', 'tour_booking', 'newsletter']),
            'tour_id' => null,
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'message' => fake()->paragraphs(2, true),
            'status' => fake()->randomElement(['new', 'read', 'replied']),
        ];
    }
}
