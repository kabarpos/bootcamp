<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(3),
            'excerpt' => fake()->paragraph(),
            'content' => fake()->paragraphs(5, true),
            'author_id' => User::factory(),
            'is_published' => fake()->boolean(80), // 80% chance of being published
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Indicate that the blog post is published.
     *
     * @return $this
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => true,
                'published_at' => now(),
            ];
        });
    }

    /**
     * Indicate that the blog post is draft.
     *
     * @return $this
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_published' => false,
                'published_at' => null,
            ];
        });
    }
}