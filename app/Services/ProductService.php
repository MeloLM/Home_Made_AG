<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Product Service
 *
 * Handles all business logic related to products.
 * Implements caching strategies and orchestrates repository calls.
 *
 * Following the Single Responsibility Principle (SRP):
 * - Repository handles data access
 * - Service handles business logic
 * - Controller handles HTTP concerns
 */
class ProductService implements ProductServiceInterface
{
    /**
     * Cache TTL in seconds (1 hour).
     */
    private const CACHE_TTL = 3600;

    /**
     * Cache key prefixes.
     */
    private const CACHE_PREFIX_FEATURED = 'products_featured_';
    private const CACHE_PREFIX_LATEST = 'products_latest_';
    private const CACHE_PREFIX_BY_EVENT = 'products_event_';

    /**
     * Create a new service instance.
     */
    public function __construct(
        protected ProductRepositoryInterface $productRepository
    ) {
    }

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
    ): LengthAwarePaginator {
        // For paginated results, we skip caching to ensure accurate pagination
        // But we could implement query-based cache keys if needed
        return $this->productRepository->getByEventSlug($eventSlug, $perPage, $filters);
    }

    /**
     * Get a single product by slug.
     */
    public function getProductBySlug(string $slug): ?Product
    {
        $product = $this->productRepository->findBySlug($slug);

        if ($product) {
            // Increment view count or trigger analytics event
            $this->trackProductView($product);
        }

        return $product;
    }

    /**
     * Get featured products for the homepage.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getFeaturedProducts(int $limit = 8): Collection
    {
        $cacheKey = self::CACHE_PREFIX_FEATURED . $limit;

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($limit): Collection {
            return $this->productRepository->getFeatured($limit);
        });
    }

    /**
     * Get latest/new arrival products.
     *
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getLatestProducts(int $limit = 8): Collection
    {
        $cacheKey = self::CACHE_PREFIX_LATEST . $limit;

        return Cache::remember($cacheKey, self::CACHE_TTL, function () use ($limit): Collection {
            return $this->productRepository->getLatest($limit);
        });
    }

    /**
     * Get products related to a given product.
     *
     * @param Product $product
     * @param int $limit
     * @return Collection<int, Product>
     */
    public function getRelatedProducts(Product $product, int $limit = 4): Collection
    {
        return $this->productRepository->getRelated($product, $limit);
    }

    /**
     * Search products by keyword.
     *
     * @param string $keyword
     * @param int $perPage
     * @return LengthAwarePaginator<Product>
     */
    public function searchProducts(string $keyword, int $perPage = 12): LengthAwarePaginator
    {
        // Sanitize and validate search keyword
        $keyword = $this->sanitizeSearchKeyword($keyword);

        if (strlen($keyword) < 2) {
            // Return empty paginator for too short queries
            return new \Illuminate\Pagination\LengthAwarePaginator(
                items: collect(),
                total: 0,
                perPage: $perPage
            );
        }

        return $this->productRepository->search($keyword, $perPage);
    }

    /**
     * Check if a product has sufficient stock.
     */
    public function hasStock(int $productId, int $requestedQuantity): bool
    {
        $product = $this->productRepository->findById($productId);

        if (! $product) {
            return false;
        }

        return $product->stock >= $requestedQuantity;
    }

    /**
     * Reserve stock for a product (used during checkout).
     */
    public function reserveStock(int $productId, int $quantity): bool
    {
        if (! $this->hasStock($productId, $quantity)) {
            Log::warning('Insufficient stock for reservation', [
                'product_id' => $productId,
                'requested' => $quantity,
            ]);

            return false;
        }

        $success = $this->productRepository->decrementStock($productId, $quantity);

        if ($success) {
            $this->clearProductCaches();
        }

        return $success;
    }

    /**
     * Release reserved stock (used when order is cancelled).
     */
    public function releaseStock(int $productId, int $quantity): bool
    {
        $success = $this->productRepository->incrementStock($productId, $quantity);

        if ($success) {
            $this->clearProductCaches();
        }

        return $success;
    }

    /**
     * Clear product-related caches.
     */
    public function clearProductCaches(): void
    {
        // Clear featured products cache
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget(self::CACHE_PREFIX_FEATURED . $i);
            Cache::forget(self::CACHE_PREFIX_LATEST . $i);
        }

        // In production, you might use cache tags instead:
        // Cache::tags(['products'])->flush();
    }

    /**
     * Track product view for analytics.
     */
    protected function trackProductView(Product $product): void
    {
        // This could dispatch a job, fire an event, or update analytics
        // For now, we'll just log it
        Log::info('Product viewed', [
            'product_id' => $product->id,
            'product_slug' => $product->slug,
        ]);
    }

    /**
     * Sanitize search keyword to prevent injection attacks.
     */
    protected function sanitizeSearchKeyword(string $keyword): string
    {
        // Remove special characters that could affect LIKE queries
        $keyword = preg_replace('/[%_]/', '', $keyword);

        // Trim and limit length
        $keyword = trim((string) $keyword);
        $keyword = mb_substr($keyword, 0, 100);

        return $keyword;
    }
}
