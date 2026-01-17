<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Product Service Interface
 *
 * Defines the contract for product business logic.
 * Following the Interface Segregation Principle (ISP).
 */
interface ProductServiceInterface
{
    /**
     * Get products for a specific event.
     *
     * @param string $eventSlug
     * @param int $perPage
     * @param array<string, mixed> $filters
     * @return LengthAwarePaginator<Product>
     */
    public function getProductsByEvent(
        string $eventSlug,
        int $perPage = 12,
        array $filters = []
    ): LengthAwarePaginator;

    /**
     * Get a single product by slug.
     */
    public function getProductBySlug(string $slug): ?Product;

    /**
     * Get featured products for the homepage.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getFeaturedProducts(int $limit = 8): Collection;

    /**
     * Get latest/new arrival products.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getLatestProducts(int $limit = 8): Collection;

    /**
     * Get products related to a given product.
     *
     * @param Product $product
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getRelatedProducts(Product $product, int $limit = 4): Collection;

    /**
     * Search products by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator<Product>
     */
    public function searchProducts(string $keyword, int $perPage = 12): LengthAwarePaginator;

    /**
     * Check if a product has sufficient stock.
     */
    public function hasStock(int $productId, int $requestedQuantity): bool;

    /**
     * Reserve stock for a product (used during checkout).
     */
    public function reserveStock(int $productId, int $quantity): bool;

    /**
     * Release reserved stock (used when order is cancelled).
     */
    public function releaseStock(int $productId, int $quantity): bool;
}
