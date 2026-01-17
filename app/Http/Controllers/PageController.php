<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

/**
 * Page Controller
 *
 * Gestisce le pagine statiche del sito.
 */
class PageController extends Controller
{
    /**
     * Pagina "Chi Siamo".
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Pagina "Contatti".
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Pagina FAQ.
     */
    public function faq(): View
    {
        return view('pages.faq');
    }

    /**
     * Pagina Spedizioni.
     */
    public function shipping(): View
    {
        return view('pages.shipping');
    }

    /**
     * Pagina Resi e Rimborsi.
     */
    public function returns(): View
    {
        return view('pages.returns');
    }

    /**
     * Privacy Policy.
     */
    public function privacy(): View
    {
        return view('pages.privacy');
    }

    /**
     * Termini e Condizioni.
     */
    public function terms(): View
    {
        return view('pages.terms');
    }

    /**
     * Cookie Policy.
     */
    public function cookies(): View
    {
        return view('pages.cookies');
    }
}
