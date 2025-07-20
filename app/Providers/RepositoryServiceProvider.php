<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\Dashboard\CategoryRepositoryInterface;
use App\Repositories\Dashboard\CategoryRepository;
use App\Interfaces\Client\CartRepositoryInterface;
use App\Repositories\Client\CartRepository;
use App\Interfaces\Common\OrderRepositoryInterface;
use App\Repositories\Common\OrderRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
      $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
      $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

      $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
