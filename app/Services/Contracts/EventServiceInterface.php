<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

/**
 * Event Service Interface
 *
 * Defines the contract for event business logic.
 * Events serve as the category system for "Shop by Event" navigation.
 */
interface EventServiceInterface
{
    /**
     * Get all active events for display.
     *
     * @return Collection<int, Event>
     */
    public function getAllEvents(): Collection;

    /**
     * Get an event by slug.
     */
    public function getEventBySlug(string $slug): ?Event;

    /**
     * Get events for navigation menu.
     *
     * @return Collection<int, Event>
     */
    public function getEventsForNavigation(): Collection;

    /**
     * Get events with their product counts.
     *
     * @return Collection<int, Event>
     */
    public function getEventsWithProductCounts(): Collection;
}
