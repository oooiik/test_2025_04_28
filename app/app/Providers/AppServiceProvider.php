<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Category;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use app\Services\Api\ProductService;
use app\Services\Api\CategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryRepository(new Category());
        });
        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductRepository(new Product());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
