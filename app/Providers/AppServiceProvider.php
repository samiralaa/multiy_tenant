<?php

namespace App\Providers;

use App\Repositories\EloquentContactRepository;
use App\Repositories\EloquentProjectRepository;
use App\Repositories\EloquentRequestPriceRepository;
use App\Repositories\EloquentUserRepository;

use Domain\Repositories\ContactRepositoryInterface;
use Domain\Repositories\ProjectRepositoryInterface;
use Domain\Repositories\RequestPriceRepositoryInterface;
use Domain\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, EloquentContactRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, EloquentProjectRepository::class);
        $this->app->bind(RequestPriceRepositoryInterface::class, EloquentRequestPriceRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
