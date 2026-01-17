<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Services\Contracts\EventServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

/**
 * Event Service
 *
 * Handles all business logic related to events.
 * Events serve as the category system for "Shop by Event" navigation.
 */
class EventService implements EventServiceInterface
{
    /**
     * Cache TTL in seconds (2 hours - events change less frequently).
     */
    private const CACHE_TTL = 7200;

    /**
     * Cache key prefixes.
     */
    private const CACHE_KEY_ALL = 'events_all';
    private const CACHE_KEY_NAVIGATION = 'events_navigation';
    private const CACHE_KEY_WITH_COUNTS = 'events_with_counts';

    /**
     * Create a new service instance.
     */
    public function __construct(
        protected EventRepositoryInterface $eventRepository
    ) {
    }

    /**
     * Get all active events for display.
     *
     * @return Collection<int, Event>
     */
    public function getAllEvents(): Collection
    {
        return Cache::remember(self::CACHE_KEY_ALL, self::CACHE_TTL, function (): Collection {
            return $this->eventRepository->getAllActive();
        });
    }

    /**
     * Get an event by slug.
     */
    public function getEventBySlug(string $slug): ?Event
    {
        return $this->eventRepository->findBySlug($slug);
    }

    /**
     * Get events for navigation menu.
     *
     * @return Collection<int, Event>
     */
    public function getEventsForNavigation(): Collection
    {
        return Cache::remember(self::CACHE_KEY_NAVIGATION, self::CACHE_TTL, function (): Collection {
            return $this->eventRepository->getForNavigation();
        });
    }

    /**
     * Get events with their product counts.
     *
     * @return Collection<int, Event>
     */
    public function getEventsWithProductCounts(): Collection
    {
        return Cache::remember(self::CACHE_KEY_WITH_COUNTS, self::CACHE_TTL, function (): Collection {
            return $this->eventRepository->getWithProductCounts();
        });
    }

    /**
     * Clear event-related caches.
     */
    public function clearEventCaches(): void
    {
        Cache::forget(self::CACHE_KEY_ALL);
        Cache::forget(self::CACHE_KEY_NAVIGATION);
        Cache::forget(self::CACHE_KEY_WITH_COUNTS);
    }
}
