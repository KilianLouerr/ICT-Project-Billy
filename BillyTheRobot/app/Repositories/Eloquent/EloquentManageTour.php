<?php

namespace App\Repositories\Eloquent;

use App\Models\Tour;
use App\Repositories\Contracts\ManageTourRepository;

class EloquentManageTour implements ManageTourRepository
{
    private Tour $tourModel;

    public function __construct(Tour $tourModel)
    {
        $this->tourModel = $tourModel;
    }

    public function addTour(string $name, string $description = ''): bool
    {
        $tour = new Tour();
        $tour->name = $name;
        $tour->description = $description;
        $tour->save();
        return true;
    }

    public function editTour(Tour $tour): bool
    {
        $tourFound = $this->tourModel->findOrFail($tour['id']);
        if (!$tourFound) {
            return false;
        }

        $tourFound = $tour;
        $tourFound->update();
        return true;
    }

    public function getAllTours()
    {
        return $this->tourModel->get();
    }

    public function removeTour(int $id): bool
    {
        $tour = $this->tourModel->find($id);

        if (!$tour) {
            return false;
        } else {
            $tour->delete();
        }

        return true;
    }
}
