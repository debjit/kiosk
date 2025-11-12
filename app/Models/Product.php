<?php

declare(strict_types=1);

namespace App\Models;

use App\Casts\PriceCast;
use Carbon\CarbonInterface;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string|null $description
 * @property-read float $price
 * @property-read int $type_id
 * @property-read bool $featured
 * @property-read int $recommendation_score
 * @property-read string|null $category
 * @property-read string|null $sku
 * @property-read int $stock_quantity
 * @property-read bool $is_active
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read string $formatted_price
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Tag> $tags
 */
final class Product extends Model
{
    /**
     * @use HasFactory<ProductFactory>
     */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'type_id',
        'featured',
        'recommendation_score',
        'category',
        'sku',
        'stock_quantity',
        'is_active',
    ];

    /**
     * @return BelongsTo<ProductType, $this>
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    /**
     * @return BelongsToMany<Tag, $this>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            Tag::class,
            'product_tags',
            'product_id',
            'tag_id',
        )
            ->withPivot('confidence_score')
            ->withTimestamps()
            ->orderByPivot('confidence_score', 'desc');
    }

    /**
     * Scope for featured products.
     */
    #[\Illuminate\Database\Eloquent\Attributes\Scope]
    protected function featured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for active products.
     */
    #[\Illuminate\Database\Eloquent\Attributes\Scope]
    protected function active($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for products by recommendation score.
     */
    #[\Illuminate\Database\Eloquent\Attributes\Scope]
    protected function byRecommendationScore($query, $minScore = 1)
    {
        return $query->where('recommendation_score', '>=', $minScore);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'description' => 'string',
            'price' => PriceCast::class,
            'type_id' => 'integer',
            'featured' => 'boolean',
            'recommendation_score' => 'integer',
            'category' => 'string',
            'sku' => 'string',
            'stock_quantity' => 'integer',
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the formatted price attribute.
     */
    protected function getFormattedPriceAttribute(): string
    {
        return '$'.number_format($this->price, 2);
    }
}
