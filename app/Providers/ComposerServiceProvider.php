<?php

namespace IVSales\Providers;

use IVSales\Http\ViewComposers\CartComposer;
use IVSales\Http\ViewComposers\CurrencyComposer;
use IVSales\Http\ViewComposers\CurrencySymbolComposer;
use IVSales\Http\ViewComposers\NavComposer;
use IVSales\Http\ViewComposers\SliderComposer;
use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.master', NavComposer::class);
        View::composer('partials.main.carousel', SliderComposer::class);
        View::composer('*', CartComposer::class);
        View::composer('layouts.master', CurrencyComposer::class);
        View::composer('*', CurrencySymbolComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
