<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Event Model
 *
 * Represents life events/occasions for which jewelry products are suitable.
 * Acts as the category system for the "Shop by Event" UX strategy.
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $image
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property bool $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Collection<int, Product> $products
 */
class Event extends Model
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
        'description',
        'image',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
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
     * Get the products associated with this event.
     *
     * @return BelongsToMany<Product>
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'event_product')
            ->withPivot(['is_featured_in_event', 'sort_order'])
            ->withTimestamps()
            ->orderByPivot('sort_order');
    }

    /**
     * Get only active products for this event.
     *
     * @return BelongsToMany<Product>
     */
    public function activeProducts(): BelongsToMany
    {
        return $this->products()
            ->where('products.is_active', true);
    }

    /**
     * Get featured products for this event.
     *
     * @return BelongsToMany<Product>
     */
    public function featuredProducts(): BelongsToMany
    {
        return $this->activeProducts()
            ->wherePivot('is_featured_in_event', true);
    }

    /**
     * Scope: Only active events.
     *
     * @param Builder<Event> $query
     * @return Builder<Event>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order by sort_order.
     *
     * @param Builder<Event> $query
     * @return Builder<Event>
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the full URL for the event image.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image) {
            return null;
        }

        return asset('storage/' . $this->image);
    }

    /**
     * Get the product count for this event.
     */
    public function getProductCountAttribute(): int
    {
        return $this->activeProducts()->count();
    }
}
