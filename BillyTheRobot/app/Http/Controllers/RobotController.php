<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ManageRobotsRepository;
use App\Repositories\Contracts\ManageTourRepository;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class RobotController extends Controller
{
    private ManageRobotsRepository $robots;
    private ManageTourRepository $tours;

    public function __construct(ManageRobotsRepository $manageRobots, ManageTourRepository $manageTours)
    {
        $this->robots = $manageRobots;
        $this->tours = $manageTours;
    }

    public function assignTourToRobot($id, $tour)
    {
        $this->robots->assignTourToRobot($id, $tour);
    }

    public function addRobot()
    {
        $this->robots->addRobot();

        return redirect()->route('manageRobots', 'all');
    }

    public function removeRobot(Request $request)
    {
        $robotId = $request->input('robotId');

        $this->robots->removeRobot($robotId);

        return redirect()->route('manageRobots', 'all');
    }

    public function saveRobot(Request $request)
    {
        $robotName = $request->input('newRobotName');
        $robotId = $request->input('robotId');
        $tour =  $request->input('tourSelected');

        $robot = $this->robots->getRobotById($robotId);

        $robot['name'] = $robotName;

        $robotArray = $robot->toArray();
        $this->robots->editRobot($robotId, $robotArray);

        $this->assignTourToRobot($robotId, $tour);

        return redirect()->route('manageRobots', 'all');
    }

    public function showManageRobots(string $value)
    {
        $robots = $this->robots->getFilteredRobots($value);

        return view('manage_robots', [
            'robots' => $robots,
            'tours' => $this->tours->getAllTours(),
        ]);
    }
    public function toggleButton(Request $request)
    {

        $robotId = $request->input('robotId');

        $robot = $this->robots->getRobotById($robotId);


        if ($robot['status'] == "active") {
            $robot['status'] = "inactive";
        } else if ($robot['status'] == "inactive") {
            $robot['status'] = "active";
        }

        $robotArray = $robot->toArray();
        $this->robots->editRobot($robotId, $robotArray);

        return redirect()->route('manageRobots', 'all');
    }
}
