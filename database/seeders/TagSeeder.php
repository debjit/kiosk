<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'name' => 'Minimalist',
                'description' => 'Clean, simple designs with minimal embellishments',
                'is_active' => true,
            ],
            [
                'name' => 'Elegant',
                'description' => 'Sophisticated and refined style',
                'is_active' => true,
            ],
            [
                'name' => 'Classic',
                'description' => 'Timeless traditional designs',
                'is_active' => true,
            ],
            [
                'name' => 'Modern',
                'description' => 'Contemporary and trendy styles',
                'is_active' => true,
            ],
            [
                'name' => 'Vintage',
                'description' => 'Retro and antique-inspired pieces',
                'is_active' => true,
            ],
            [
                'name' => 'Bohemian',
                'description' => 'Free-spirited and artistic designs',
                'is_active' => true,
            ],
            [
                'name' => 'Statement',
                'description' => 'Bold and eye-catching pieces',
                'is_active' => true,
            ],
            [
                'name' => 'Delicate',
                'description' => 'Fine and dainty jewelry',
                'is_active' => true,
            ],
            [
                'name' => 'Chunky',
                'description' => 'Thick and substantial pieces',
                'is_active' => true,
            ],
            [
                'name' => 'Layered',
                'description' => 'Multiple pieces worn together',
                'is_active' => true,
            ],
            [
                'name' => 'Gold',
                'description' => 'Gold-colored or gold-plated jewelry',
                'is_active' => true,
            ],
            [
                'name' => 'Silver',
                'description' => 'Silver-colored or sterling silver jewelry',
                'is_active' => true,
            ],
            [
                'name' => 'Rose Gold',
                'description' => 'Warm pinkish-gold tone jewelry',
                'is_active' => true,
            ],
            [
                'name' => 'Diamond',
                'description' => 'Pieces featuring diamonds',
                'is_active' => true,
            ],
            [
                'name' => 'Gemstone',
                'description' => 'Jewelry with colored gemstones',
                'is_active' => true,
            ],
            [
                'name' => 'Pearl',
                'description' => 'Elegant pearl jewelry',
                'is_active' => true,
            ],
            [
                'name' => 'Crystal',
                'description' => 'Sparkling crystal embellishments',
                'is_active' => true,
            ],
            [
                'name' => 'Everyday',
                'description' => 'Suitable for daily wear',
                'is_active' => true,
            ],
            [
                'name' => 'Occasion',
                'description' => 'Special event and formal wear',
                'is_active' => true,
            ],
            [
                'name' => 'Stackable',
                'description' => 'Designed to be worn in multiples',
                'is_active' => true,
            ],
        ];

        foreach ($tags as $tagData) {
            \App\Models\Tag::query()->create($tagData);
        }
    }
}
