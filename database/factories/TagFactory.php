<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
final class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = [
            ['name' => 'Minimalist', 'description' => 'Clean, simple designs with minimal embellishments'],
            ['name' => 'Elegant', 'description' => 'Sophisticated and refined style'],
            ['name' => 'Classic', 'description' => 'Timeless traditional designs'],
            ['name' => 'Modern', 'description' => 'Contemporary and trendy styles'],
            ['name' => 'Vintage', 'description' => 'Retro and antique-inspired pieces'],
            ['name' => 'Bohemian', 'description' => 'Free-spirited and artistic designs'],
            ['name' => 'Statement', 'description' => 'Bold and eye-catching pieces'],
            ['name' => 'Delicate', 'description' => 'Fine and dainty jewelry'],
            ['name' => 'Chunky', 'description' => 'Thick and substantial pieces'],
            ['name' => 'Layered', 'description' => 'Multiple pieces worn together'],
            ['name' => 'Gold', 'description' => 'Gold-colored or gold-plated jewelry'],
            ['name' => 'Silver', 'description' => 'Silver-colored or sterling silver jewelry'],
            ['name' => 'Rose Gold', 'description' => 'Warm pinkish-gold tone jewelry'],
            ['name' => 'Diamond', 'description' => 'Pieces featuring diamonds'],
            ['name' => 'Gemstone', 'description' => 'Jewelry with colored gemstones'],
            ['name' => 'Pearl', 'description' => 'Elegant pearl jewelry'],
            ['name' => 'Crystal', 'description' => 'Sparkling crystal embellishments'],
            ['name' => 'Everyday', 'description' => 'Suitable for daily wear'],
            ['name' => 'Occasion', 'description' => 'Special event and formal wear'],
            ['name' => 'Stackable', 'description' => 'Designed to be worn in multiples'],
        ];

        $tag = $this->faker->randomElement($tags);

        return [
            'name' => $tag['name'],
            'description' => $tag['description'],
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
        ];
    }

    /**
     * Indicate that the tag is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes): array => [
            'is_active' => false,
        ]);
    }

    /**
     * Create a tag with a specific name.
     */
    public function withName(string $name): static
    {
        return $this->state(fn (array $attributes): array => [
            'name' => $name,
        ]);
    }
}
