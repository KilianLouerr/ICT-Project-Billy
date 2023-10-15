<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ManageRoutesRepository;
use DB;
use App\Repositories\Contracts\ManageTourRepository;
use App\Repositories\Contracts\ManageMediaRepository;
use App\Models\Media;

class MediaRouteController extends Controller
{
    private ManageRoutesRepository $route;
    private ManageTourRepository $tours;
    private ManageMediaRepository $media;
    
    public function __construct(ManageRoutesRepository $manageRoute, ManageTourRepository $manageTours, ManageMediaRepository $manageMedia) {
        $this->route = $manageRoute;
        $this->tours = $manageTours;
        $this->media = $manageMedia;
    }
    
    public function linkMedia(Request $request){
        $mediaHtml = $request->input('mediaHtml');
        $mediaName = $request->input('mediaName');
        $mediaLink = $request->input('mediaLink');
        $idTour = $request->input('tourId');
        
        $order = $request->input('order');
        
        if ($mediaHtml == null){
            $mediaType = "link";
            
            $id = $this->media->addMedia($mediaName,$mediaType, $mediaLink);
        }
        if ($mediaLink == null){
            $mediaType = "html";
            
            $id = $this->media->addMedia($mediaName,$mediaType, $mediaHtml);
        }
        
        $data=array("tour_id"=>$idTour,"route_id"=>-1,"order"=>$order, "information_id" => $id);
        DB::table('route_tour')->insert($data);

        return redirect()->route('manageTours');
    }
            
    public function linkRoute(Request $request){
        
        $idRoute = $request->input('selectedRoute');
        $idTour = $request->input('tourId');
        
        $order = $request->input('order');
        
        $data=array("tour_id"=>$idTour,"route_id"=>$idRoute,"order"=>$order, "information_id" => -1);
        DB::table('route_tour')->insert($data);
        
        return redirect()->route('manageTours');
    }
    
    public function getAllRoutes()
    {
        $routes = $this->route->getAllRoutes();
        $routesNames = [];

        foreach ($routes as $route) {
            $slocation = DB::table('locations')->select('name')->where('id', $route['start_point'])->value('name');
            $elocation = DB::table('locations')->select('name')->where('id', $route['end_point'])->value('name');

            $routeNames = [
                'id' => $route['id'],
                'sid' => $route['start_point'],
                'sname' => $slocation,
                'eid' => $route['end_point'],
                'ename' => $elocation,
            ];

            array_push($routesNames, $routeNames);
        }

        return $routesNames;
    }
    
    public function showAddMediaRoute()
    {
        $idTour = request('idTour');
        $order = request('order');
        
        return view('add_media_route', [
            'routes' => $this->getAllRoutes(),
            'idTour' => $idTour,
            'order' => $order
        ]);
    }
}
