<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductType>
 */
final class ProductTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['Ring', 'Pendant', 'Chain', 'Bracelet', 'Earrings', 'Necklace'];

        $name = $this->faker->unique()->randomElement($types);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->optional(0.7)->sentence(),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}
