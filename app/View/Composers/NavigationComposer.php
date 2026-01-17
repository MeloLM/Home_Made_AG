<?php

declare(strict_types=1);

namespace App\View\Composers;

use App\Services\Contracts\EventServiceInterface;
use Illuminate\View\View;

/**
 * Navigation Composer
 *
 * Condivide i dati degli eventi con tutte le viste
 * che necessitano della navigazione "Shop by Event".
 */
class NavigationComposer
{
    /**
     * Crea una nuova istanza del composer.
     */
    public function __construct(
        protected EventServiceInterface $eventService
    ) {
    }

    /**
     * Lega i dati alla vista.
     */
    public function compose(View $view): void
    {
        $view->with('navigationEvents', $this->eventService->getEventsForNavigation());
    }
}
