<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ManageRoutesRepository;
use App\Repositories\Eloquent\EloquentManageRoutes;

/**
 * Description of RepositoryServiceProvider
 *
 * @author nicky
 */
class RepositoryServiceProvider extends ServiceProvider{
    public function register()
    {
        $this->app->singleton(ManageRoutesRepository::class, EloquentManageRoutes::class);
    }

}
