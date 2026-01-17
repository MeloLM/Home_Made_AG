<?php

declare(strict_types=1);

use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rotte principali dell'e-commerce di gioielli artigianali.
| Organizzate per sezione: Home, Eventi, Prodotti, Carrello, Pagine statiche.
|
*/

// ============================================================================
// HOME
// ============================================================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ============================================================================
// EVENTI (Shop by Event)
// ============================================================================
Route::prefix('eventi')->name('events.')->group(function (): void {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{slug}', [EventController::class, 'show'])->name('show');
});

// ============================================================================
// PRODOTTI
// ============================================================================
Route::prefix('prodotti')->name('products.')->group(function (): void {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/cerca', [ProductController::class, 'search'])->name('search');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

// ============================================================================
// CARRELLO (placeholder per ora)
// ============================================================================
Route::prefix('carrello')->name('cart.')->group(function (): void {
    Route::get('/', function () {
        return view('cart.index');
    })->name('index');
});

// ============================================================================
// ACCOUNT (placeholder per ora)
// ============================================================================
Route::prefix('account')->name('account.')->middleware('auth')->group(function (): void {
    Route::get('/ordini', function () {
        return view('account.orders');
    })->name('orders');

    Route::get('/profilo', function () {
        return view('account.profile');
    })->name('profile');
});

// ============================================================================
// PAGINE STATICHE
// ============================================================================
Route::get('/chi-siamo', [PageController::class, 'about'])->name('about');
Route::get('/contatti', [PageController::class, 'contact'])->name('contact');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/spedizioni', [PageController::class, 'shipping'])->name('shipping');
Route::get('/resi-rimborsi', [PageController::class, 'returns'])->name('returns');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/termini-condizioni', [PageController::class, 'terms'])->name('terms');
Route::get('/cookie-policy', [PageController::class, 'cookies'])->name('cookies');

// ============================================================================
// AUTH ROUTES (Laravel Breeze/Fortify - da installare)
// ============================================================================
// Placeholder per le rotte di autenticazione
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout');
