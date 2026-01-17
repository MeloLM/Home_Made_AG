<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Contracts\EventServiceInterface;
use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\View\View;

/**
 * Home Controller
 *
 * Gestisce la homepage del sito e-commerce.
 */
class HomeController extends Controller
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
     * Mostra la homepage.
     */
    public function index(): View
    {
        $events = $this->eventService->getEventsWithProductCounts();
        $featuredProducts = $this->productService->getFeaturedProducts(8);
        $latestProducts = $this->productService->getLatestProducts(4);

        return view('home', compact('events', 'featuredProducts', 'latestProducts'));
    }
}
