<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(App\Http\Controllers\Api\CityController::class)->group(function () {
    Route::get('/regions', 'regions');
    Route::get('/distincts/{region}', 'distincts');
    Route::get('/cities/{region}/{distinct}', 'cities');
    Route::get('/cities/{cityId}', 'view');
});
Route::controller(App\Http\Controllers\Api\AssignmentController::class)->group(function () {
    Route::get('/assignments', 'index');
});
Route::controller(App\Http\Controllers\Api\ListingController::class)->group(function () {
    Route::get('/listings','index');
    Route::post('/listings', 'create');
    Route::get('/listings/{listingId}', 'view');
    Route::post('/listings/{listingId}','update');
    Route::delete('/listings/{listingId}','delete');
});
Route::controller(App\Http\Controllers\Api\UserController::class)->group(function () {
    Route::get('/user/{token}', 'user');
    Route::post('/user/{id}', 'update');
    Route::get('/user/listings/{id}','getListingsByUser');
});
