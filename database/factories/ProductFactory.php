<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
final class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->optional(0.8)->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 5000), // Price between $10.00 and $5000.00
            'type_id' => ProductType::factory(),
            'featured' => $this->faker->boolean(20), // 20% chance of being featured
            'recommendation_score' => $this->faker->numberBetween(1, 10),
            'category' => $this->faker->optional(0.6)->randomElement(['Gold', 'Silver', 'Platinum', 'Diamond', 'Gemstone']),
            'sku' => $this->faker->boolean(90) ? $this->faker->unique()->regexify('[A-Z]{3}[0-9]{6}') : null,
            'stock_quantity' => $this->faker->numberBetween(0, 1000),
            'is_active' => $this->faker->boolean(85), // 85% chance of being active
        ];
    }
}
