<?php

namespace App\Repositories\Contracts;

interface ManageRobotsRepository
{
    public function addRobot();
    public function assignTourToRobot(int $id, int $tour);
    public function editRobot(int $id, array $data): bool;
    public function getFilteredRobots(string $filter);
    public function getRobotById($id);
    public function removeRobot(int $id): bool;
}
