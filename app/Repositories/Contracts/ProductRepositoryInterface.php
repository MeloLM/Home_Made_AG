<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Product Repository Interface
 *
 * Defines the contract for product database interactions.
 * Following the Repository Pattern to abstract data layer.
 */
interface ProductRepositoryInterface
{
    /**
     * Get all active products.
     *
     * @return Collection<int, Product>
     */
    public function getAllActive(): Collection;

    /**
     * Get a product by its ID.
     */
    public function findById(int $id): ?Product;

    /**
     * Get a product by its slug.
     */
    public function findBySlug(string $slug): ?Product;

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
    ): LengthAwarePaginator;

    /**
     * Get featured products.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getFeatured(int $limit = 8): Collection;

    /**
     * Get latest products.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getLatest(int $limit = 8): Collection;

    /**
     * Search products by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator<Product>
     */
    public function search(string $keyword, int $perPage = 12): LengthAwarePaginator;

    /**
     * Get related products based on shared events.
     *
     * @param Product $product
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getRelated(Product $product, int $limit = 4): Collection;

    /**
     * Create a new product.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Product;

    /**
     * Update an existing product.
     *
     * @param int $id
     * @param array<string, mixed> $data
     */
    public function update(int $id, array $data): ?Product;

    /**
     * Delete a product (soft delete).
     */
    public function delete(int $id): bool;

    /**
     * Decrement product stock.
     */
    public function decrementStock(int $productId, int $quantity): bool;

    /**
     * Increment product stock.
     */
    public function incrementStock(int $productId, int $quantity): bool;
}
