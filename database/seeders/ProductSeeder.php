<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

final class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create product types only if they don't exist
        if (ProductType::query()->count() === 0) {
            $productTypes = [
                [
                    'name' => 'Ring',
                    'slug' => 'ring',
                    'description' => 'Beautiful rings for every occasion',
                    'is_active' => true,
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Pendant',
                    'slug' => 'pendant',
                    'description' => 'Elegant pendants to complement your style',
                    'is_active' => true,
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Chain',
                    'slug' => 'chain',
                    'description' => 'High-quality chains for necklaces and bracelets',
                    'is_active' => true,
                    'sort_order' => 3,
                ],
                [
                    'name' => 'Bracelet',
                    'slug' => 'bracelet',
                    'description' => 'Stunning bracelets for everyday wear',
                    'is_active' => true,
                    'sort_order' => 4,
                ],
                [
                    'name' => 'Earrings',
                    'slug' => 'earrings',
                    'description' => 'Elegant earrings to complete your look',
                    'is_active' => true,
                    'sort_order' => 5,
                ],
                [
                    'name' => 'Necklace',
                    'slug' => 'necklace',
                    'description' => 'Beautiful necklaces for special occasions',
                    'is_active' => true,
                    'sort_order' => 6,
                ],
            ];

            foreach ($productTypes as $typeData) {
                ProductType::query()->create($typeData);
            }
        }

        // Create some sample products only if they don't exist
        if (Product::query()->count() === 0) {
            ProductType::all()->each(function ($type): void {
                Product::factory()->count(5)->create([
                    'type_id' => $type->id,
                ]);
            });
        }
    }
}
