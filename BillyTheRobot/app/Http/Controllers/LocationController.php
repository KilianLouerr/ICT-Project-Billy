<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ManageLocationsRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private ManageLocationsRepository $location;

    public function __construct(ManageLocationsRepository $location)
    {
        $this->location = $location;
    }

    public function addLocation(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|alpha_num',
            'description' => 'required|alpha_num',
        ], [
                'name.required' => 'Geef de naam van de locatie!',
                'description.required' => 'Geef een beschrijving van de locatie!',
                'name.alpha_num' => 'De naam mag enkel uit letters en cijfers bestaan!',
                'description.alpha_num' => 'De naam mag enkel uit letters en cijfers bestaan!'
            ]);

        $name = $request->input('name');
        $description = $request->input('description');
        $this->location->addLocation($name, $description);

        return back();
    }

    public function removeSelectedLocations(Request $request)
    {
        if ($request->input('point_id') === null) {
            return back();
        }

        $locations = $request->input('point_id');
        $locationIds = array_values($locations);
        $this->location->removeSelectedLocations($locationIds);

        return back();
    }

    public function showManageLocationsView()
    {
        $points = $this->location->getAllLocations();

        return view('manage_location', [
            'points' => $points,
        ]);
    }
}