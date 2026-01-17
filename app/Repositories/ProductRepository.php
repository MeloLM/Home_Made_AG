<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Eloquent Product Repository
 *
 * Handles all database interactions for the Product model.
 * Implements the Repository Pattern for clean separation of concerns.
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * Create a new repository instance.
     */
    public function __construct(
        protected Product $model
    ) {
    }

    /**
     * Get all active products.
     *
     * @return Collection<int, Product>
     */
    public function getAllActive(): Collection
    {
        return $this->model
            ->active()
            ->ordered()
            ->with('events')
            ->get();
    }

    /**
     * Get a product by its ID.
     */
    public function findById(int $id): ?Product
    {
        return $this->model
            ->with('activeEvents')
            ->find($id);
    }

    /**
     * Get a product by its slug.
     */
    public function findBySlug(string $slug): ?Product
    {
        return $this->model
            ->active()
            ->with('activeEvents')
            ->where('slug', $slug)
            ->first();
    }

    /**
     * Get products by event slug with pagination.
     *
     * @param string $eventSlug
     * @param int $perPage
     * @param array<string, mixed> $filters
     * @return LengthAwarePaginator<Product>
     */
    public function getByEventSlug(
        string $eventSlug,
        int $perPage = 12,
        array $filters = []
    ): LengthAwarePaginator {
        $query = $this->model
            ->active()
            ->byEvent($eventSlug)
            ->with('activeEvents');

        $query = $this->applyFilters($query, $filters);
        $query = $this->applySorting($query, $filters['sort'] ?? 'default');

        return $query->paginate($perPage);
    }

    /**
     * Get featured products.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getFeatured(int $limit = 8): Collection
    {
        return $this->model
            ->active()
            ->featured()
            ->ordered()
            ->with('activeEvents')
            ->limit($limit)
            ->get();
    }

    /**
     * Get latest products.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getLatest(int $limit = 8): Collection
    {
        return $this->model
            ->active()
            ->latest()
            ->with('activeEvents')
            ->limit($limit)
            ->get();
    }

    /**
     * Search products by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator<Product>
     */
    public function search(string $keyword, int $perPage = 12): LengthAwarePaginator
    {
        return $this->model
            ->active()
            ->where(function (Builder $query) use ($keyword): void {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('short_description', 'like', "%{$keyword}%")
                    ->orWhere('materials', 'like', "%{$keyword}%");
            })
            ->with('activeEvents')
            ->ordered()
            ->paginate($perPage);
    }

    /**
     * Get related products based on shared events.
     *
     * @param Product $product
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getRelated(Product $product, int $limit = 4): Collection
    {
        $eventIds = $product->events->pluck('id')->toArray();

        if (empty($eventIds)) {
            return $this->model
                ->active()
                ->where('id', '!=', $product->id)
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }

        return $this->model
            ->active()
            ->where('id', '!=', $product->id)
            ->whereHas('events', function (Builder $query) use ($eventIds): void {
                $query->whereIn('events.id', $eventIds);
            })
            ->with('activeEvents')
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    /**
     * Create a new product.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Product
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing product.
     *
     * @param int $id
     * @param array<string, mixed> $data
     */
    public function update(int $id, array $data): ?Product
    {
        $product = $this->findById($id);

        if (! $product) {
            return null;
        }

        $product->update($data);

        return $product->fresh();
    }

    /**
     * Delete a product (soft delete).
     */
    public function delete(int $id): bool
    {
        $product = $this->findById($id);

        if (! $product) {
            return false;
        }

        return (bool) $product->delete();
    }

    /**
     * Decrement product stock.
     */
    public function decrementStock(int $productId, int $quantity): bool
    {
        return (bool) $this->model
            ->where('id', $productId)
            ->where('stock', '>=', $quantity)
            ->decrement('stock', $quantity);
    }

    /**
     * Increment product stock.
     */
    public function incrementStock(int $productId, int $quantity): bool
    {
        return (bool) $this->model
            ->where('id', $productId)
            ->increment('stock', $quantity);
    }

    /**
     * Apply filters to the query.
     *
     * @param Builder<Product> $query
     * @param array<string, mixed> $filters
     * @return Builder<Product>
     */
    protected function applyFilters(Builder $query, array $filters): Builder
    {
        // Filter by price range
        if (isset($filters['min_price']) && isset($filters['max_price'])) {
            $query->priceBetween((float) $filters['min_price'], (float) $filters['max_price']);
        } elseif (isset($filters['min_price'])) {
            $query->where('price', '>=', (float) $filters['min_price']);
        } elseif (isset($filters['max_price'])) {
            $query->where('price', '<=', (float) $filters['max_price']);
        }

        // Filter by handmade only
        if (isset($filters['handmade']) && $filters['handmade']) {
            $query->handmade();
        }

        // Filter by in-stock only
        if (isset($filters['in_stock']) && $filters['in_stock']) {
            $query->inStock();
        }

        return $query;
    }

    /**
     * Apply sorting to the query.
     *
     * @param Builder<Product> $query
     * @param string $sort
     * @return Builder<Product>
     */
    protected function applySorting(Builder $query, string $sort): Builder
    {
        return match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            'newest' => $query->latest(),
            default => $query->ordered(),
        };
    }
}
