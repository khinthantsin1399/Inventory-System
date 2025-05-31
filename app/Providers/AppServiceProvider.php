<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('App\Contracts\Services\ProductServiceInterface', 'App\Services\ProductService');
        $this->app->bind('App\Contracts\Dao\ProductDaoInterface', 'App\Dao\ProductDao');

        $this->app->bind('App\Contracts\Services\CategoryServiceInterface', 'App\Services\CategoryService');
        $this->app->bind('App\Contracts\Dao\CategoryDaoInterface', 'App\Dao\CategoryDao');

        $this->app->bind('App\Contracts\Services\BrandServiceInterface', 'App\Services\BrandService');
        $this->app->bind('App\Contracts\Dao\BrandDaoInterface', 'App\Dao\BrandDao');

        $this->app->bind('App\Contracts\Services\SystemFileServiceInterface', 'App\Services\SystemFileService');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
