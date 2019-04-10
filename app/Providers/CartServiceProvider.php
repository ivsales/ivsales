<?php

namespace IVSales\Providers;

use IVSales\Components\Cart\Cart;
use IVSales\Components\Cart\CartItemCreator;
use IVSales\Repositories\Cart\RepositoryContract;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
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
        $this->app->singleton('Cart', Cart::class);
        $this->app->singleton(Cart::class, Cart::class);
    }
}
