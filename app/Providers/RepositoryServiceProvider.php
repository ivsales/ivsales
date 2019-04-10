<?php

namespace IVSales\Providers;

use IVSales\Repositories\Cart\RepositoryContract;
use IVSales\Repositories\Cart\SessionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryContract::class, function () {
            if (config('shopping_cart.driver') === 'session') {
                return new SessionRepository;
            }
            return null;
        });
    }
}
