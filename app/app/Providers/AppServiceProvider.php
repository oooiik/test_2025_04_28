<?php

namespace App\Providers;

use App\Http\Resources\ArticleCollection;
use app\Http\Resources\CategoryCollection;
use App\Models\Article;
use App\Models\Category;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use app\Services\Api\ArticleService;
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
        $this->app->singleton(ArticleCollection::class, function ($app) {
            return new ArticleService(new ArticleRepository(new Article()));
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
