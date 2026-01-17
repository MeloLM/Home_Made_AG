<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\EventRepository;
use App\Repositories\ProductRepository;
use App\Services\Contracts\EventServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use App\Services\EventService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

/**
 * Repository Service Provider
 *
 * Binds repository and service interfaces to their concrete implementations.
 * This enables dependency injection and makes the application testable.
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        // Repositories
        ProductRepositoryInterface::class => ProductRepository::class,
        EventRepositoryInterface::class => EventRepository::class,

        // Services
        ProductServiceInterface::class => ProductService::class,
        EventServiceInterface::class => EventService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        // Additional bindings can be registered here if needed
        // For complex bindings that require closures or conditional logic
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
