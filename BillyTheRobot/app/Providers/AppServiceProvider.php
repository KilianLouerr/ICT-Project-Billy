<?php

namespace App\Providers;

use App\Repositories\Eloquent\EloquentLogin;
use App\Repositories\Eloquent\EloquentManageLocations;
use App\Repositories\Eloquent\EloquentManageRobots;
use App\Repositories\Eloquent\EloquentManageRoutes;
use App\Repositories\Eloquent\EloquentManageTour;
use App\Repositories\Eloquent\EloquentMedia;
use App\Repositories\Contracts\LoginRepository;
use App\Repositories\Contracts\ManageRobotsRepository;
use App\Repositories\Contracts\ManageRoutesRepository;
use App\Repositories\Contracts\ManageTourRepository;
use App\Repositories\Contracts\ManageLocationsRepository;
use App\Repositories\Contracts\ManageMediaRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginRepository::class, EloquentLogin::class);
        $this->app->singleton(ManageLocationsRepository::class, EloquentManageLocations::class);
        $this->app->singleton(ManageRobotsRepository::class, EloquentManageRobots::class);
        $this->app->singleton(ManageRoutesRepository::class, EloquentManageRoutes::class);
        $this->app->singleton(ManageTourRepository::class, EloquentManageTour::class);
        $this->app->singleton(ManageMediaRepository::class, EloquentMedia::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
