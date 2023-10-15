<?php

namespace App\Repositories\Contracts;

interface ManageRoutesRepository
{
    public function addRoute(int $start_id, int $stop_id, array $instructions);
    public function getAllRoutes();
    public function removeSelectedRoutes(array $id);
}
