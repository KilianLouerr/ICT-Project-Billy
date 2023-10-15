<?php

namespace App\Repositories\Eloquent;

use App\Models\Location;
use App\Repositories\Contracts\ManageLocationsRepository;
use App\Models\Route;

class EloquentManageLocations implements ManageLocationsRepository
{
    private Location $locationModel;

    public function __construct(Location $locationModel)
    {
        $this->locationModel = $locationModel;
    }

    public function addLocation(string $name, string $description)
    {
        $location = new Location();
        $location->name = $name;
        $location->description = $description;
        $location->save();

        return $location;
    }

    public function getAllLocations()
    {
        $locationModel = new Location();
        $locations = $locationModel->all(['id', 'name', 'description'])->mapWithKeys(function ($location) {
            return [$location['id'] => $location];
        });

        return $locations->toArray();
    }

    public function removeSelectedLocations(array $locationIds)
    {
        $routeModel = new Route();
        $routes = $routeModel->all();

        foreach ($locationIds as $id) {
            $location = $this->locationModel->find($id);
            if (!$location) {
                return false;
            }
            foreach ($routes as $route) {
                if ($id == $route['start_point'] || $id == $route['end_point']) {
                    $route->delete();
                }
            }
            $location->delete();
        }

        return true;
    }
}
