<?php

use App\Http\Controllers\BlindTastingController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GrapeVarietyController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\WineController;
use App\Http\Controllers\WineTypeController;
use App\Http\Controllers\WineVintageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/blind-tasting', [BlindTastingController::class, 'create']);
Route::get('/countries', [CountryController::class, 'getAll']);
Route::get('/grape-varieties', [GrapeVarietyController::class, 'getAll']);
Route::post('/producer', [ProducerController::class, 'create']);
Route::get('/producer/{id}', [ProducerController::class, 'getOne']);
Route::get('/producer/{id}/wines', [ProducerController::class, 'getWines']);
Route::get('/producers', [ProducerController::class, 'getAll']);
Route::post('/wine', [WineController::class, 'create']);
Route::get('/wine/{id}', [WineController::class, 'getWithVintages']);
Route::get('/wine/{id}/vintage/{vintage}', [WineVintageController::class, 'getOne']);
Route::get('/wines', [WineController::class, 'getAll']);
Route::post('/wine-comment', [WineVintageController::class, 'createComment']);
Route::post('/wine-comment/{id}/wine-vintage', [WineVintageController::class, 'createAndLinkComment']);
Route::get('/wine-types', [WineTypeController::class, 'getAll']);
Route::post('/wine-vintage', [WineVintageController::class, 'create']);
Route::get('/wine-vintage/{id}', [WineVintageController::class, 'getById']);
Route::put('/wine-vintage/{id}', [WineVintageController::class, 'edit']);
Route::get('/wine-vintage/{id}/wine-comments', [WineVintageController::class, 'getWineComments']);
