<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;

/**
 * Event Repository Interface
 *
 * Defines the contract for event database interactions.
 * Events act as categories in the "Shop by Event" system.
 */
interface EventRepositoryInterface
{
    /**
     * Get all active events ordered by sort_order.
     *
     * @return Collection<int, Event>
     */
    public function getAllActive(): Collection;

    /**
     * Get an event by its ID.
     */
    public function findById(int $id): ?Event;

    /**
     * Get an event by its slug.
     */
    public function findBySlug(string $slug): ?Event;

    /**
     * Get events with product counts.
     *
     * @return Collection<int, Event>
     */
    public function getWithProductCounts(): Collection;

    /**
     * Get events for navigation (limited fields).
     *
     * @return Collection<int, Event>
     */
    public function getForNavigation(): Collection;

    /**
     * Create a new event.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Event;

    /**
     * Update an existing event.
     *
     * @param int $id
     * @param array<string, mixed> $data
     */
    public function update(int $id, array $data): ?Event;

    /**
     * Delete an event (soft delete).
     */
    public function delete(int $id): bool;
}
