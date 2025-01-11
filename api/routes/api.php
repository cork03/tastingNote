<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\GrapeVarietyController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\WineController;
use App\Http\Controllers\WineTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/producer', [ProducerController::class, 'create']);
Route::get('/producers', [ProducerController::class, 'getAll']);
Route::get('/grape_varieties', [GrapeVarietyController::class, 'getAll']);
Route::get('/producer/{id}/wines', [ProducerController::class, 'getWines']);
Route::get('/wine_types', [WineTypeController::class, 'getAll']);
Route::post('/wine', [WineController::class, 'create']);
Route::post('/wine_vintage', [WineController::class, 'createWineVintage']);
Route::get('/countries', [CountryController::class, 'getAll']);
