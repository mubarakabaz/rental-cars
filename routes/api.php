<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [UserController::class, 'register']);
Route::post('/cars', [CarController::class, 'store']);
Route::get('/cars', [CarController::class, 'index']);
Route::get('/cars/search', [CarController::class, 'search']);
Route::post('/rentals', [RentalController::class, 'store']);
Route::post('/rentals/return', [RentalController::class, 'returnCar']);
Route::get('/user/{id}/rentals', [RentalController::class, 'userRentals']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
