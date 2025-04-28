<?php

namespace App\Providers;

use app\Http\Resources\CategoryCollection;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use app\Services\Api\CategoryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CategoryCollection::class, function ($app) {
            return new CategoryService(new CategoryRepository(new Category()));
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
