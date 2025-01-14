<?php

namespace App\Providers;

use App\Infrastructure\QueryBuilder\ClientQuery;
use App\ReadModels\ClientQueryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ClientQueryInterface::class, ClientQuery::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
