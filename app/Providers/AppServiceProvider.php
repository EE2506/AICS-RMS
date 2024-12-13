<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set a custom Livewire update route
       /* Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/custom/livewire/update', $handle)
                ->middleware(['web']);
        });

        // Set a custom route for the Livewire JS file
        Livewire::setScriptRoute(function ($handle) {
            return Route::get('/custom/livewire/livewire.js', $handle);
        });*/
    }
}
