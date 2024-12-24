<?php

namespace App\Providers;

use App\Services\Basket\BasketService;
use App\Services\Basket\Contracts\IBasketService;
use App\Services\Product\Contracts\IProductService;
use App\Services\Product\ProductService;
use App\Services\User\Contracts\IUserService;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(IUserService::class , function(){
            return new UserService();
        });

        $this->app->singleton(IProductService::class , function(){
            return new ProductService();
        });

        $this->app->singleton(IBasketService::class , function(){
            return new BasketService();
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
