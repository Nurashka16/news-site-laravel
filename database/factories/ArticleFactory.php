<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'description' => fake()->paragraph(2),
            'content' => fake()->paragraphs(3, true),
            'preview_image' => 'images/' . fake()->numberBetween(1, 4) . '.jpg',
            'full_image' => 'images/' . fake()->numberBetween(1, 4) . '.jpg',
            'published_at' => fake()->dateTimeBetween('-1 month', '+1 month'),
        ];
    }
}