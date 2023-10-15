<?php

namespace App\Repositories\Eloquent;

use App\Models\Tour;
use App\Repositories\Contracts\ManageRobotsRepository;
use App\Models\User;
use Dotenv\Util\Str;

class EloquentManageRobots implements ManageRobotsRepository
{
    private User $robotModel;

    public function __construct(User $robotModel)
    {
        $this->robotModel = $robotModel;
    }

    public function addRobot(): bool
    {
        $this->robotModel = User::create([
            'name' => "New Robot",
            'type' => 'User',
            'status' => "inactive",
            'tour_id' => -1,
            'location' => "",
            'password' => ""
        ]);

        return true;
    }

    public function assignTourToRobot($id, $tour)
    {
        $robot = $this->robotModel->findOrFail($id);

        if (!$robot) {
            return false;
        }

        $robot->tour_id = $tour;
        $robot->update();

        return true;
    }

    public function editRobot(int $id, array $data): bool
    {
        $robot = $this->robotModel->findOrFail($id);

        if (!$robot) {
            return false;
        }

        $robot->name = $data['name'];
        $robot->status = $data['status'];
        $robot->update($data);

        return true;
    }

    public function getFilteredRobots(string $filter)
    {
        if ($filter == 'all') {
            return $this->robotModel->where('type', 'User')->get();
        }

        return $this->robotModel->where([
            ['type', 'User'],
            ['status', $filter]
        ])->get();
    }

    public function getRobotById($id)
    {
        return $this->robotModel->find($id);
    }

    public function removeRobot(int $id): bool
    {
        $robot = $this->robotModel->find($id);

        if (!$robot) {
            return false;
        } else {
            $robot->delete();
        }

        return true;
    }
}
