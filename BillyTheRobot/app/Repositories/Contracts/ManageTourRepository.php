<?php

namespace App\Repositories\Contracts;

use App\Models\Tour;

interface ManageTourRepository
{
    public function addTour(string $name, string $description = ''): bool;
    public function editTour(Tour $tour): bool;
    public function getAllTours();
    public function removeTour(int $id): bool;
}
