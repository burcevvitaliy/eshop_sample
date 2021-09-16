<?php

namespace App\Providers;

use App\Repository\Eloquent\OrderItemRepository;
use App\Repository\Eloquent\OrderRepository;
use App\Repository\OrderItemRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class Order extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
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
