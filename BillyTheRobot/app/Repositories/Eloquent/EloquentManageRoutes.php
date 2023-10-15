<?php

namespace App\Repositories\Eloquent;

use App\Models\Location;
use App\Repositories\Contracts\ManageRoutesRepository;
use App\Models\Route;

class EloquentManageRoutes implements ManageRoutesRepository
{
    private Route $routeModel;

    public function __construct(Route $routeModel)
    {
        $this->routeModel = $routeModel;
    }

    public function addRoute(int $start_id, int $stop_id, array $instructions): Route
    {
        $route = new Route();
        $route->start_point = $start_id;
        $route->end_point = $stop_id;
        $route->instructions = json_encode($instructions);
        $route->save();

        return $route;
    }

    public function getAllRoutes()
    {
        return $this->routeModel->get();
    }

    public function removeSelectedRoutes(array $routeIds)
    {
        foreach ($routeIds as $id) {
            $route = $this->routeModel->find($id);
            if (!$route) {
                return false;
            }
            $route->delete();
        }
        
        return true;
    }
}
