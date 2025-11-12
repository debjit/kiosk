<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        // Create demo products for each product type if there are no products yet
        if (Product::query()->count() === 0) {
            // Ensure base tags exist before attaching
            $tagNames = [
                'Minimalist',
                'Elegant',
                'Classic',
                'Modern',
                'Vintage',
                'Bohemian',
                'Statement',
                'Delicate',
                'Chunky',
                'Layered',
                'Gold',
                'Silver',
                'Rose Gold',
                'Diamond',
                'Gemstone',
                'Pearl',
                'Crystal',
                'Everyday',
                'Occasion',
                'Stackable',
            ];

            $tagsByName = Tag::query()
                ->whereIn('name', $tagNames)
                ->get()
                ->keyBy('name');

            $resolveTags = (static fn (array $names): array => collect($names)
                ->map(fn (string $name) => $tagsByName[$name] ?? null)
                ->filter()
                ->pluck('id')
                ->all());

            $demoProducts = [
                'ring' => [
                    [
                        'name' => 'Classic Gold Solitaire Ring',
                        'description' => 'Timeless 18K yellow gold solitaire ring with a brilliant-cut cubic zirconia centerpiece.',
                        'price' => 12999,
                        'featured' => true,
                        'recommendation_score' => 9,
                        'category' => 'Gold',
                        'sku' => 'RNGCLSG001',
                        'stock_quantity' => 25,
                        'tags' => ['Classic', 'Elegant', 'Gold', 'Occasion'],
                    ],
                    [
                        'name' => 'Rose Gold Eternity Band',
                        'description' => 'Elegant 14K rose gold eternity ring with micro-pave simulated diamonds all around.',
                        'price' => 8999,
                        'featured' => false,
                        'recommendation_score' => 8,
                        'category' => 'Gold',
                        'sku' => 'RNGETRN002',
                        'stock_quantity' => 40,
                        'tags' => ['Rose Gold', 'Stackable', 'Everyday'],
                    ],
                    [
                        'name' => 'Sterling Silver Stacking Ring Set',
                        'description' => 'Set of three minimalist sterling silver stacking rings for everyday wear.',
                        'price' => 3499,
                        'featured' => false,
                        'recommendation_score' => 7,
                        'category' => 'Silver',
                        'sku' => 'RNGSTCK003',
                        'stock_quantity' => 60,
                        'tags' => ['Minimalist', 'Silver', 'Stackable', 'Everyday'],
                    ],
                ],
                'pendant' => [
                    [
                        'name' => 'Pear Drop Diamond Pendant',
                        'description' => 'Delicate pear-shaped simulated diamond pendant in 18K white gold-plated setting.',
                        'price' => 7499,
                        'featured' => true,
                        'recommendation_score' => 9,
                        'category' => 'Diamond',
                        'sku' => 'PNDPEAR001',
                        'stock_quantity' => 30,
                        'tags' => ['Diamond', 'Elegant', 'Classic', 'Occasion'],
                    ],
                    [
                        'name' => 'Heart Locket Pendant',
                        'description' => 'Polished sterling silver heart locket pendant with space for two photos.',
                        'price' => 2999,
                        'featured' => false,
                        'recommendation_score' => 7,
                        'category' => 'Silver',
                        'sku' => 'PNDLOCK002',
                        'stock_quantity' => 45,
                        'tags' => ['Vintage', 'Everyday', 'Silver'],
                    ],
                    [
                        'name' => 'Emerald Halo Pendant',
                        'description' => 'Oval-cut green stone surrounded by a halo of clear crystals on a fine chain.',
                        'price' => 5599,
                        'featured' => false,
                        'recommendation_score' => 8,
                        'category' => 'Gemstone',
                        'sku' => 'PNDEMHD003',
                        'stock_quantity' => 20,
                        'tags' => ['Gemstone', 'Statement', 'Occasion'],
                    ],
                ],
                'chain' => [
                    [
                        'name' => 'Curb Link Gold Chain',
                        'description' => 'Heavyweight curb link chain in gold-tone stainless steel, 22 inches.',
                        'price' => 6599,
                        'featured' => true,
                        'recommendation_score' => 8,
                        'category' => 'Gold',
                        'sku' => 'CHNCURB001',
                        'stock_quantity' => 35,
                        'tags' => ['Gold', 'Statement', 'Modern'],
                    ],
                    [
                        'name' => 'Box Chain Silver Necklace',
                        'description' => 'Slim sterling silver box chain, perfect for everyday pendants.',
                        'price' => 2499,
                        'featured' => false,
                        'recommendation_score' => 7,
                        'category' => 'Silver',
                        'sku' => 'CHNBOX002',
                        'stock_quantity' => 80,
                        'tags' => ['Silver', 'Minimalist', 'Everyday'],
                    ],
                    [
                        'name' => 'Figaro Chain Platinum Finish',
                        'description' => 'Classic Figaro chain with platinum finish for a modern look.',
                        'price' => 5299,
                        'featured' => false,
                        'recommendation_score' => 7,
                        'category' => 'Platinum',
                        'sku' => 'CHNFIG003',
                        'stock_quantity' => 25,
                        'tags' => ['Modern', 'Layered', 'Statement'],
                    ],
                ],
                'bracelet' => [
                    [
                        'name' => 'Tennis Bracelet Classic',
                        'description' => 'Adjustable tennis bracelet with brilliant simulated diamonds.',
                        'price' => 6499,
                        'featured' => true,
                        'recommendation_score' => 9,
                        'category' => 'Diamond',
                        'sku' => 'BRTTNS001',
                        'stock_quantity' => 22,
                        'tags' => ['Diamond', 'Elegant', 'Occasion'],
                    ],
                    [
                        'name' => 'Leather Wrap Bracelet',
                        'description' => 'Double-wrap genuine leather bracelet with stainless steel clasp.',
                        'price' => 1999,
                        'featured' => false,
                        'recommendation_score' => 7,
                        'category' => 'Gemstone',
                        'sku' => 'BRTLTH002',
                        'stock_quantity' => 50,
                        'tags' => ['Bohemian', 'Everyday', 'Statement'],
                    ],
                    [
                        'name' => 'Charm Link Bracelet',
                        'description' => 'Silver-tone charm bracelet with customizable links.',
                        'price' => 2799,
                        'featured' => false,
                        'recommendation_score' => 7,
                        'category' => 'Silver',
                        'sku' => 'BRTCHM003',
                        'stock_quantity' => 40,
                        'tags' => ['Stackable', 'Silver', 'Everyday'],
                    ],
                ],
                'earrings' => [
                    [
                        'name' => 'Round Stud Earrings',
                        'description' => '4mm round-cut simulated diamond studs with secure screw backs.',
                        'price' => 1599,
                        'featured' => true,
                        'recommendation_score' => 10,
                        'category' => 'Diamond',
                        'sku' => 'EARSTD001',
                        'stock_quantity' => 100,
                        'tags' => ['Everyday', 'Diamond', 'Minimalist'],
                    ],
                    [
                        'name' => 'Gold Hoop Earrings',
                        'description' => 'Medium-sized 14K gold-plated hoop earrings for daily wear.',
                        'price' => 2299,
                        'featured' => false,
                        'recommendation_score' => 8,
                        'category' => 'Gold',
                        'sku' => 'EARHOP002',
                        'stock_quantity' => 70,
                        'tags' => ['Gold', 'Everyday', 'Modern'],
                    ],
                    [
                        'name' => 'Pearl Drop Earrings',
                        'description' => 'Classic faux pearl drops on sterling silver hooks.',
                        'price' => 1899,
                        'featured' => false,
                        'recommendation_score' => 8,
                        'category' => 'Gemstone',
                        'sku' => 'EARPRL003',
                        'stock_quantity' => 55,
                        'tags' => ['Pearl', 'Elegant', 'Occasion'],
                    ],
                ],
                'necklace' => [
                    [
                        'name' => 'Layered Pendant Necklace',
                        'description' => 'Two-layer gold-tone necklace with coin and bar pendants.',
                        'price' => 3199,
                        'featured' => true,
                        'recommendation_score' => 9,
                        'category' => 'Gold',
                        'sku' => 'NCKLYR001',
                        'stock_quantity' => 45,
                        'tags' => ['Layered', 'Gold', 'Statement'],
                    ],
                    [
                        'name' => 'Minimal Bar Necklace',
                        'description' => 'Sleek sterling silver bar necklace for a modern minimalist look.',
                        'price' => 2599,
                        'featured' => false,
                        'recommendation_score' => 8,
                        'category' => 'Silver',
                        'sku' => 'NCKBAR002',
                        'stock_quantity' => 60,
                        'tags' => ['Minimalist', 'Silver', 'Everyday'],
                    ],
                    [
                        'name' => 'Blue Stone Statement Necklace',
                        'description' => 'Bold blue faceted stones set in gold-tone chain for special occasions.',
                        'price' => 4299,
                        'featured' => false,
                        'recommendation_score' => 8,
                        'category' => 'Gemstone',
                        'sku' => 'NCKBLU003',
                        'stock_quantity' => 25,
                        'tags' => ['Gemstone', 'Statement', 'Occasion'],
                    ],
                ],
            ];

            ProductType::all()->each(function (ProductType $type) use ($demoProducts, $resolveTags): void {
                $slug = Str::slug($type->slug ?: $type->name);

                $productsToCreate = $demoProducts[$slug] ?? [];

                if (count($productsToCreate) === 0) {
                    // Fallback: create 3 generic but valid products for unknown types
                    for ($i = 1; $i <= 3; $i++) {
                        $product = Product::query()->create([
                            'name' => $type->name.' Demo '.$i,
                            'description' => 'Demo '.$type->name.' product '.$i.' for kiosk showcase.',
                            'price' => 1999 + ($i * 500),
                            'type_id' => $type->id,
                            'featured' => $i === 1,
                            'recommendation_score' => 6 + $i,
                            'category' => 'Gold',
                            'sku' => mb_strtoupper(mb_substr($type->slug, 0, 3)).'DEM0'.$i,
                            'stock_quantity' => 15 * $i,
                            'is_active' => true,
                        ]);

                        $fallbackTags = $resolveTags(['Everyday', 'Classic']);
                        if ($fallbackTags !== []) {
                            $product->tags()->syncWithoutDetaching($fallbackTags);
                        }
                    }

                    return;
                }

                foreach (array_slice($productsToCreate, 0, 3) as $data) {
                    $tags = $resolveTags($data['tags'] ?? []);

                    unset($data['tags']);

                    $product = Product::query()->create(array_merge($data, [
                        'type_id' => $type->id,
                        'is_active' => true,
                    ]));

                    if ($tags !== []) {
                        $product->tags()->syncWithoutDetaching($tags);
                    }
                }
            });
        }
    }
}
