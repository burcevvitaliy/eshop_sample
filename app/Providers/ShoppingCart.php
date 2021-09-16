<?php

namespace App\Providers;

use App\Repository\Eloquent\ShoppingCartItemRepository;
use App\Repository\Eloquent\ShoppingCartRepository;
use App\Repository\ShoppingCartItemRepositoryInterface;
use App\Repository\ShoppingCartRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ShoppingCart extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ShoppingCartItemRepositoryInterface::class, ShoppingCartItemRepository::class);
        $this->app->bind(ShoppingCartRepositoryInterface::class, ShoppingCartRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
