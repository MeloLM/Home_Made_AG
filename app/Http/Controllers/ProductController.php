<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Contracts\ProductServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Product Controller
 *
 * Gestisce la visualizzazione dei prodotti.
 */
class ProductController extends Controller
{
    /**
     * Crea una nuova istanza del controller.
     */
    public function __construct(
        protected ProductServiceInterface $productService
    ) {
    }

    /**
     * Mostra tutti i prodotti.
     */
    public function index(Request $request): View
    {
        // Per ora reindirizza alla pagina eventi
        // In futuro potrebbe mostrare tutti i prodotti
        $products = $this->productService->searchProducts('', 12);

        return view('products.index', compact('products'));
    }

    /**
     * Mostra un prodotto specifico.
     */
    public function show(string $slug): View
    {
        $product = $this->productService->getProductBySlug($slug);

        if (! $product) {
            throw new NotFoundHttpException('Prodotto non trovato.');
        }

        $relatedProducts = $this->productService->getRelatedProducts($product, 4);

        return view('products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Cerca prodotti.
     */
    public function search(Request $request): View
    {
        $query = $request->get('q', '');
        $products = $this->productService->searchProducts($query, 12);

        return view('products.search', compact('products', 'query'));
    }
}
