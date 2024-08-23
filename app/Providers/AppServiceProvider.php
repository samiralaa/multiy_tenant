<?php

namespace App\Providers;

use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentContactRepository;
use Domain\Repositories\ContactRepositoryInterface;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
