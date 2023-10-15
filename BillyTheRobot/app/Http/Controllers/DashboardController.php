<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ManageRobotsRepository;
use App\Repositories\Contracts\ManageTourRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    private ManageRobotsRepository $robots;
    private ManageTourRepository $tours;

    public function __construct(ManageRobotsRepository $robots, ManageTourRepository $manageTours)
    {
        $this->robots = $robots;
        $this->tours = $manageTours;
    }

    public function showDashboard()
    {
        $robots = $this->robots->getFilteredRobots('active');

        return view('dashboard', [
            'robots' => $robots,
            'tours' => $this->tours->getAllTours(),
        ]);
    }
}
