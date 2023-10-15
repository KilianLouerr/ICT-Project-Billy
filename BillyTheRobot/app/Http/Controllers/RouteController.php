<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ManageLocationsRepository;
use App\Repositories\Contracts\ManageRoutesRepository;
use Illuminate\Support\Facades\Session;

class RouteController extends Controller
{
    private ManageRoutesRepository $route;
    private ManageLocationsRepository $location;

    public function __construct(ManageRoutesRepository $route, ManageLocationsRepository $location)
    {
        $this->route = $route;
        $this->location = $location;
    }

    public function addRoute(Request $request)
    {
        $validatedData = $request->validate([
            'start_point' => 'required|integer',
            'end_point' => 'required|integer'
        ], [
                'start_point.required' => 'Selecteer een startpunt',
                'end_point.required' => 'Selecteer een eindpunt'
            ]);

        $instructions = Session::get('instructions');

        if (is_null($instructions) || empty($instructions)) {
            return back()->withErrors(['instructionsError' => 'Maak de instructies aan!']);
        }

        $start_point = (int) $request->input('start_point');
        $end_point = (int) $request->input('end_point');

        $this->route->addRoute($start_point, $end_point, $instructions);

        Session::forget('_old_input');
        Session::forget('instructions');

        return back();
    }

    public function addInstruction(Request $request)
    {
        $validatedData = $request->validate([
            'value' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $command = $request->input('command');
                    if ($command == 'turn') {
                        if ($value < -180 || $value > 180 || $value == 0) {
                            $fail('De waarde moet tussen -180 en 180 graden liggen en mag niet 0 zijn.');
                        }
                    } elseif ($command == 'forward') {
                        if ($value < 0 || $value > 1000) {
                            $fail('De waarde moet tussen 0 en 1000 meter zijn.');
                        }
                    }

                },
            ],
        ]);

        $command = $request->input('command');
        $value = $request->input('value');

        $instructions = Session::get('instructions');

        if ($instructions === null) {
            $instructions = [];
        }

        $newInstruction = array(
            "command" => $command,
            "value" => $value
        );

        array_push($instructions, $newInstruction);
        Session::put('instructions', $instructions);

        return back();
    }

    public function editInstruction(Request $request)
    {
        $value = $_COOKIE['value'];
        $command = $_COOKIE['command'];
        $instruction = $request->instruction;

        if ($command == 'turn') {
            if ($value < -180 || $value > 180 || $value == 0) {
                return back()->withErrors([$instruction => 'De waarde moet tussen -180 en 180 graden liggen en mag niet 0 zijn.']);
            }
        } elseif ($command == 'forward') {
            if ($value < 0 || $value > 1000) {
                return back()->withErrors([$instruction => 'De waarde moet tussen 0 en 1000 meter zijn.']);
            }
        }

        $instructions = Session::get('instructions');
        $instructions[$instruction]['value'] = $value;
        $instructions[$instruction]['command'] = $command;
        $instructions = array_values($instructions);
        Session::put('instructions', $instructions);

        return back();
    }

    public function removeInstruction(Request $request)
    {
        $instruction = $request->instruction;
        $instructions = Session::get('instructions');
        unset($instructions[$instruction]);
        $instructions = array_values($instructions);
        Session::put('instructions', $instructions);

        return back();
    }

    public function removeInstructions(Request $request)
    {
        $instructions = Session::get('instructions');
        $instructions = [];
        Session::put('instructions', $instructions);

        return back();
    }

    public function removeSelectedRoutes(Request $request)
    {
        $routes = $request->input('allRoutes');
        if (!is_null($routes)) {
            $routeIds = array_values($routes);
            $this->route->removeSelectedRoutes($routeIds);
        }

        return back();
    }

    public function setSelectPoints(Request $request)
    {
        $selectName = $request->selectName;
        $selectValue = $request->selectValue;
        $request->session()->put('_old_input.' . $selectName, $selectValue);

        return back();
    }

    public function showManageRoutesView()
    {
        $points = $this->location->getAllLocations();
        $routes = $this->route->getAllRoutes();
        $instructions = Session::get('instructions');

        if ($instructions === null) {
            $instructions = [];
        }

        return view('manage_routes', [
            'points' => $points,
            'instructions' => $instructions,
            'routes' => $routes
        ]);
    }
}