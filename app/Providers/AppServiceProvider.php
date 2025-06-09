<?php

namespace App\Providers;

use App\Contracts\RepositoryContracts\CategoryRepositoryContract;
use App\Contracts\RepositoryContracts\OrderRepositoryContract;
use App\Contracts\RepositoryContracts\ProductRepositoryContract;
use App\Contracts\ServiceContracts\OrderServiceContract;
use App\Contracts\ServiceContracts\ProductServiceContract;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {

        $this->app->bind(CategoryRepositoryContract::class, CategoryRepository::class);
        $this->app->bind(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryContract::class, OrderRepository::class);


        $this->app->bind(ProductServiceContract::class, ProductService::class);
        $this->app->bind(OrderServiceContract::class, OrderService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
