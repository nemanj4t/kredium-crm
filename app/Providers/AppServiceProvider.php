<?php

namespace App\Providers;

use App\Infrastructure\QueryBuilder\ClientQuery;
use App\Infrastructure\QueryBuilder\ReportQuery;
use App\Models\Loans\Loan;
use App\Policies\LoanPolicy;
use App\ReadModels\ClientQueryInterface;
use App\ReadModels\ReportQueryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ClientQueryInterface::class, ClientQuery::class);
        $this->app->singleton(ReportQueryInterface::class, ReportQuery::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Loan::class, LoanPolicy::class);
    }
}
