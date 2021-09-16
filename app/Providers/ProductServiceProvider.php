<?php

namespace App\Providers;

use App\Repository\AttributeRepositoryInterface;
use App\Repository\AttributeValueRepositoryInterface;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\AttributeRepository;
use App\Repository\Eloquent\AttributeValueRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\ProductAttributeValueRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\SubcategoryRepository;
use App\Repository\ProductAttributeValueRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\SubcategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductAttributeValueRepositoryInterface::class, ProductAttributeValueRepository::class);

        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);
        $this->app->bind(AttributeValueRepositoryInterface::class, AttributeValueRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubcategoryRepositoryInterface::class, SubcategoryRepository::class);
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
