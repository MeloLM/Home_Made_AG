<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Contracts\EventServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Event Controller
 *
 * Gestisce la visualizzazione degli eventi e dei prodotti associati.
 * Implementa la strategia "Shop by Event".
 */
class EventController extends Controller
{
    /**
     * Crea una nuova istanza del controller.
     */
    public function __construct(
        protected EventServiceInterface $eventService,
        protected ProductServiceInterface $productService
    ) {
    }

    /**
     * Mostra tutti gli eventi disponibili.
     */
    public function index(): View
    {
        $events = $this->eventService->getEventsWithProductCounts();

        return view('events.index', compact('events'));
    }

    /**
     * Mostra i prodotti per un evento specifico.
     */
    public function show(Request $request, string $slug): View
    {
        $event = $this->eventService->getEventBySlug($slug);

        if (! $event) {
            throw new NotFoundHttpException('Evento non trovato.');
        }

        // Prepara i filtri dalla query string
        $filters = $this->prepareFilters($request);

        // Ottieni i prodotti paginati per questo evento
        $products = $this->productService->getProductsByEvent(
            $slug,
            perPage: 12,
            filters: $filters
        );

        // Opzioni di ordinamento per la vista
        $sortOptions = $this->getSortOptions();

        return view('events.show', compact('event', 'products', 'sortOptions', 'filters'));
    }

    /**
     * Prepara i filtri dalla request.
     *
     * @return array<string, mixed>
     */
    protected function prepareFilters(Request $request): array
    {
        return [
            'sort' => $request->get('sort', 'default'),
            'min_price' => $request->get('min_price'),
            'max_price' => $request->get('max_price'),
            'handmade' => $request->boolean('handmade'),
            'in_stock' => $request->boolean('in_stock'),
        ];
    }

    /**
     * Ottieni le opzioni di ordinamento.
     *
     * @return array<string, string>
     */
    protected function getSortOptions(): array
    {
        return [
            'default' => 'Rilevanza',
            'newest' => 'Novità',
            'price_asc' => 'Prezzo: dal più basso',
            'price_desc' => 'Prezzo: dal più alto',
            'name_asc' => 'Nome: A-Z',
            'name_desc' => 'Nome: Z-A',
        ];
    }
}
