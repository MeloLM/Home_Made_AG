<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Eloquent Event Repository
 *
 * Handles all database interactions for the Event model.
 * Events serve as the category system for "Shop by Event" navigation.
 */
class EventRepository implements EventRepositoryInterface
{
    /**
     * Create a new repository instance.
     */
    public function __construct(
        protected Event $model
    ) {
    }

    /**
     * Get all active events ordered by sort_order.
     *
     * @return Collection<int, Event>
     */
    public function getAllActive(): Collection
    {
        return $this->model
            ->active()
            ->ordered()
            ->get();
    }

    /**
     * Get an event by its ID.
     */
    public function findById(int $id): ?Event
    {
        return $this->model->find($id);
    }

    /**
     * Get an event by its slug.
     */
    public function findBySlug(string $slug): ?Event
    {
        return $this->model
            ->active()
            ->where('slug', $slug)
            ->first();
    }

    /**
     * Get events with product counts.
     *
     * @return Collection<int, Event>
     */
    public function getWithProductCounts(): Collection
    {
        return $this->model
            ->active()
            ->ordered()
            ->withCount(['products' => function ($query): void {
                $query->where('products.is_active', true);
            }])
            ->get();
    }

    /**
     * Get events for navigation (limited fields for performance).
     *
     * @return Collection<int, Event>
     */
    public function getForNavigation(): Collection
    {
        return $this->model
            ->active()
            ->ordered()
            ->select(['id', 'name', 'slug', 'image'])
            ->get();
    }

    /**
     * Create a new event.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Event
    {
        return $this->model->create($data);
    }

    /**
     * Update an existing event.
     *
     * @param int $id
     * @param array<string, mixed> $data
     */
    public function update(int $id, array $data): ?Event
    {
        $event = $this->findById($id);

        if (! $event) {
            return null;
        }

        $event->update($data);

        return $event->fresh();
    }

    /**
     * Delete an event (soft delete).
     */
    public function delete(int $id): bool
    {
        $event = $this->findById($id);

        if (! $event) {
            return false;
        }

        return (bool) $event->delete();
    }
}
