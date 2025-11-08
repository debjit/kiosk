<?php

declare(strict_types=1);

namespace App\Models;

use App\Events\TagCreated;
use App\Events\TagUpdated;
use Carbon\CarbonInterface;
use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Event;
use Pgvector\Laravel\Vector;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string|null $description
 * @property-read array<float>|null $embedding
 * @property-read bool $is_active
 * @property-read CarbonInterface $created_at
 * @property-read CarbonInterface $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $products
 */
final class Tag extends Model
{
    /**
     * @use HasFactory<TagFactory>
     */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'is_active',
        'embedding',
    ];

    /**
     * @return BelongsToMany<Product, $this>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('confidence_score')
            ->withTimestamps();
    }

    /**
     * Get the highest confidence score for this tag with a specific product.
     */
    public function getConfidenceScoreForProduct(Product $product): float
    {
        $pivot = $this->products()->where('product_id', $product->id)->first()?->pivot;

        return $pivot ? (float) $pivot->confidence_score : 0.0;
    }

    /**
     * Set confidence score for a specific product.
     */
    public function setConfidenceScoreForProduct(Product $product, float $score): void
    {
        $this->products()->updateExistingPivot($product->id, [
            'confidence_score' => max(0.0, min(1.0, $score)),
        ]);
    }

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        self::created(function (Tag $tag): void {
            Event::dispatch(new TagCreated($tag->id));
        });

        self::updated(function (Tag $tag): void {
            if ($tag->wasChanged(['name', 'description'])) {
                Event::dispatch(new TagUpdated($tag->id));
            }
        });
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'embedding' => config('database.default') === 'pgsql' ? Vector::class : 'array',
        ];
    }

    /**
     * Scope for active tags.
     */
    #[\Illuminate\Database\Eloquent\Attributes\Scope]
    protected function active($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for tags with embeddings.
     */
    #[\Illuminate\Database\Eloquent\Attributes\Scope]
    protected function withEmbeddings($query)
    {
        return $query->whereNotNull('embedding');
    }
}
