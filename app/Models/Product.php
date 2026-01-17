<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Product Model
 *
 * Represents handmade jewelry items (necklaces, bracelets, rosaries).
 * Products are associated with events rather than traditional categories.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $sku
 * @property string|null $description
 * @property string|null $short_description
 * @property float $price
 * @property float|null $compare_at_price
 * @property int $stock
 * @property bool $is_handmade
 * @property bool $is_active
 * @property bool $is_featured
 * @property string|null $main_image
 * @property array|null $gallery_images
 * @property string|null $materials
 * @property string|null $dimensions
 * @property int|null $weight_grams
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Collection<int, Event> $events
 * @property-read string|null $main_image_url
 * @property-read bool $in_stock
 * @property-read bool $on_sale
 * @property-read float|null $discount_percentage
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'price',
        'compare_at_price',
        'stock',
        'is_handmade',
        'is_active',
        'is_featured',
        'main_image',
        'gallery_images',
        'materials',
        'dimensions',
        'weight_grams',
        'meta_title',
        'meta_description',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'stock' => 'integer',
        'is_handmade' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'gallery_images' => 'array',
        'weight_grams' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the events associated with this product.
     *
     * @return BelongsToMany<Event>
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_product')
            ->withPivot(['is_featured_in_event', 'sort_order'])
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    /**
     * Get only active events for this product.
     *
     * @return BelongsToMany<Event>
     */
    public function activeEvents(): BelongsToMany
    {
        return $this->events()
            ->where('events.is_active', true);
    }

    /**
     * Scope: Only active products.
     *
     * @param Builder<Product> $query
     * @return Builder<Product>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Only featured products.
     *
     * @param Builder<Product> $query
     * @return Builder<Product>
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Only handmade products.
     *
     * @param Builder<Product> $query
     * @return Builder<Product>
     */
    public function scopeHandmade(Builder $query): Builder
    {
        return $query->where('is_handmade', true);
    }

    /**
     * Scope: Only in-stock products.
     *
     * @param Builder<Product> $query
     * @return Builder<Product>
     */
    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Scope: Order by sort_order.
     *
     * @param Builder<Product> $query
     * @return Builder<Product>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Scope: Products by event slug.
     *
     * @param Builder<Product> $query
     * @param string $eventSlug
     * @return Builder<Product>
     */
    public function scopeByEvent(Builder $query, string $eventSlug): Builder
    {
        return $query->whereHas('events', function (Builder $eventQuery) use ($eventSlug): void {
            $eventQuery->where('slug', $eventSlug)
                ->where('is_active', true);
        });
    }

    /**
     * Scope: Products priced between min and max.
     *
     * @param Builder<Product> $query
     * @param float $min
     * @param float $max
     * @return Builder<Product>
     */
    public function scopePriceBetween(Builder $query, float $min, float $max): Builder
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    /**
     * Get the full URL for the main product image.
     */
    protected function mainImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn (): ?string => $this->main_image
                ? asset('storage/' . $this->main_image)
                : null,
        );
    }

    /**
     * Check if the product is in stock.
     */
    protected function inStock(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->stock > 0,
        );
    }

    /**
     * Check if the product is on sale.
     */
    protected function onSale(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => $this->compare_at_price !== null
                && $this->compare_at_price > $this->price,
        );
    }

    /**
     * Get the discount percentage if the product is on sale.
     */
    protected function discountPercentage(): Attribute
    {
        return Attribute::make(
            get: function (): ?float {
                if (! $this->on_sale || $this->compare_at_price === null) {
                    return null;
                }

                return round(
                    (($this->compare_at_price - $this->price) / $this->compare_at_price) * 100,
                    1
                );
            },
        );
    }

    /**
     * Get the formatted price with currency symbol.
     */
    public function getFormattedPriceAttribute(): string
    {
        return '€' . number_format((float) $this->price, 2, ',', '.');
    }

    /**
     * Get the formatted compare-at price with currency symbol.
     */
    public function getFormattedCompareAtPriceAttribute(): ?string
    {
        if ($this->compare_at_price === null) {
            return null;
        }

        return '€' . number_format((float) $this->compare_at_price, 2, ',', '.');
    }

    /**
     * Get all gallery images including the main image.
     *
     * @return array<int, string>
     */
    public function getAllImagesAttribute(): array
    {
        $images = [];

        if ($this->main_image) {
            $images[] = asset('storage/' . $this->main_image);
        }

        if ($this->gallery_images) {
            foreach ($this->gallery_images as $image) {
                $images[] = asset('storage/' . $image);
            }
        }

        return $images;
    }
}
