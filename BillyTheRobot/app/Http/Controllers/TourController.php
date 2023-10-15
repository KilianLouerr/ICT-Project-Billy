<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ManageRoutesRepository;
use App\Repositories\Contracts\ManageTourRepository;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Tour;
use App\Models\Route;
use App\Models\Media;
use App\Models\Location;

class TourController extends Controller
{
    private ManageTourRepository $tours;
    private ManageRoutesRepository $routes;

    public function __construct(ManageTourRepository $manageTours, ManageRoutesRepository $manageRoutes)
    {
        $this->tours = $manageTours;
        $this->routes = $manageRoutes;
    }

    public function addTour()
    {
        $this->tours->addTour('Nieuwe Tour');
        return redirect()->route('manageTours');
    }

    public function removeTour(Request $request)
    {
        $this->tours->removeTour($request->input('id'));
        return redirect()->route('manageTours');
    }

    public function getTourById($id)
    {
        $tour = Tour::find($id); 
        
        if ($tour['id'] == $id) {
            return $tour;
        }

        return null;
    }

    public function saveAddTour(Request $request)
    {
        $orderCount = 0;

        if (isset($_GET['opslaanBtn'])) {
            if ($request->has('thisTourId')) {

                $idTour = $request->input('thisTourId');
                $tourName = $request->input('tourName');
                $tourDescription = $request->input('tourDescription');
                $tour = $this->getTourById($idTour);
                $tour['name'] = $tourName;
                $tour['id'] = $idTour;
                $tour['description'] = $tourDescription;

                $this->tours->editTour($tour);
            }
            return redirect()->route('manageTours');
        }

        if (isset($_GET['toevoegenBtn'])) {
            $idTour = $_GET['toevoegenBtn'];
            $routeTours = DB::table('route_tour')->where('tour_id', $idTour)->get();
            foreach ($routeTours as $routeTour) {
                $orderCount++;
            }
            $url = '/addMediaRoute?idTour=' . urlencode($idTour) . '&order=' . urlencode($orderCount);
            return redirect($url);
        }
    }
    
    public function getPointNamesFromId($start, $end)
    {
        $startName = Location::where('id', $start)->first();
        $endName = Location::where('id', $end)->first();
        return $startName['name'] . " - " . $endName['name'];
    }
    
    public function getRoutesMedias($selectedId)
    {

        $tour = Tour::find($selectedId);
        $routesMedias = array();

        if ($selectedId == -1) {
            $array['type'] = "null";
            $array['data'] = "null";
            array_push($routesMedias, $array);

            return $routesMedias;
        }

        $routeTours = $tour->getRouteTour;


        $order = 0;
        foreach ($routeTours as $routeTour) {
            if ($routeTour['order'] == $order) {

                if ($routeTour['route_id'] != -1) {
                    $route = Route::find($routeTour['route_id']);
                    $array['type'] = "Route";
                    $array['data'] = $route;
                    array_push($routesMedias, $array);
                } else if ($routeTour['information_id'] != -1) {
                    $media = Media::find($routeTour['information_id']);
                    $array['type'] = "Media";
                    $array['data'] = $media;
                    array_push($routesMedias, $array);
                }

                $order++;
            }
        }


        return $routesMedias;
    }


    public function showManageToursView()
    {
        return view('manage_tours', [
            'tours' => $this->tours->getAllTours(),
            'SelectedRoutesMedias' =>  $this->getRoutesMedias(-1)
        ]);
    }
}
