<?php

namespace App\Repositories\Contracts;

interface ManageLocationsRepository
{
    public function addLocation(string $name, string $description);
    public function getAllLocations();
    public function removeSelectedLocations(array $id);
}
