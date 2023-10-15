<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MediaRouteController;
use App\Http\Controllers\RobotController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// default
Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');

// login
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

 Route::group(['middleware' => 'auth'], function() { 
    // Location
    Route::post('/addLocation', [LocationController::class, 'addLocation'])->name('addLocation');
    Route::get('/manageLocations', [LocationController::class, 'showManageLocationsView'])->name('manageLocations');
    Route::post('/removeSelectedLocations', [LocationController::class, 'removeSelectedLocations'])->name('removeSelectedLocations');

    // Media Route
    Route::get('/addMediaRoute', [MediaRouteController::class, 'showAddMediaRoute'])->name('addMediaRoute');
    Route::get('/linkMedia', [MediaRouteController::class, 'linkMedia'])->name('linkMedia');
    Route::get('/linkRoute', [MediaRouteController::class, 'linkRoute'])->name('linkRoute');

    // Robot
    Route::get('/addRobot', [RobotController::class, 'addRobot'])->name('addRobot');
    Route::get('/manageRobots/{value}', [RobotController::class, 'showManageRobots'])->name('manageRobots');
    Route::get('/removeRobot', [RobotController::class, 'removeRobot'])->name('removeRobot');
    Route::get('/saveRobot', [RobotController::class, 'saveRobot'])->name('saveRobot');
    Route::get('/toggleButton', [RobotController::class, 'toggleButton'])->name('toggleButton');

    // Route
    Route::post('/addInstruction', [RouteController::class, 'addInstruction'])->name('addInstruction');
    Route::post('/addRoute', [RouteController::class, 'addRoute'])->name('addRoute');
    Route::get('/editInstruction/{instruction}', [RouteController::class, 'editInstruction'])->name('editInstruction');
    Route::get('/manageRoutes', [RouteController::class, 'showManageRoutesView'])->name('manageRoutes');
    Route::get('/removeInstruction/{instruction}', [RouteController::class, 'removeInstruction'])->name('removeInstruction');
    Route::get('/removeInstructions', [RouteController::class, 'removeInstructions'])->name('removeInstructions');
    Route::post('/removeSelectedRoutes', [RouteController::class, 'removeSelectedRoutes'])->name('removeSelectedRoutes');
    Route::get('/setSelectPoints/{selectName}/{selectValue}', [RouteController::class, 'setSelectPoints'])->name('setSelectPoints');

    // Tour
    Route::get('/addTour', [TourController::class, 'addTour'])->name('addTour');
    Route::get('/assignTourToRobot', [TourController::class, 'assignTourToRobot']);
    Route::get('/manageTours', [TourController::class, 'showManageToursView'])->name('manageTours');
    Route::get('/getAllTours', [TourController::class, 'getAllTours']);
    Route::get('/getRoutesMedias/{id}', [TourController::class, 'getRoutesMedias'])->name('getRoutesMedias');
    Route::get('/getPointsNames/{start}/{end}', [TourController::class, 'getPointNamesFromId'])->name('getPointsNames');
    Route::get('/removeTour', [TourController::class, 'removeTour'])->name('removeTour');
    Route::get('/saveAddTour', [TourController::class, 'saveAddTour'])->name('saveAddTour');
 });
