<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\NavigationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * View Service Provider
 *
 * Registra i View Composers per condividere dati globali con le viste.
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Condivide gli eventi con header e footer
        View::composer(
            ['layouts.partials.header', 'layouts.partials.footer'],
            NavigationComposer::class
        );
    }
}
