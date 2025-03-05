<?php

use App\Http\Controllers\AppellationController;
use App\Http\Controllers\BlindTastingController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GrapeVarietyController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\WineCommentController;
use App\Http\Controllers\WineController;
use App\Http\Controllers\WineRankingController;
use App\Http\Controllers\WineTypeController;
use App\Http\Controllers\WineVintageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/appellation', [AppellationController::class, 'create']);
Route::get('/appellations', [AppellationController::class, 'getAll']);
Route::get('/appellation/types', [AppellationController::class, 'getTypes']);
Route::post('/blind-tasting', [BlindTastingController::class, 'create']);
Route::get('/countries', [CountryController::class, 'getAll']);
Route::get('/grape-varieties', [GrapeVarietyController::class, 'getAll']);
Route::post('/producer', [ProducerController::class, 'create']);
Route::get('/producer/{id}', [ProducerController::class, 'getOne']);
Route::get('/producer/{id}/wines', [ProducerController::class, 'getWines']);
Route::get('/producers', [ProducerController::class, 'getAll']);
Route::post('/wine', [WineController::class, 'create']);
Route::get('/wine/{id}', [WineController::class, 'getWithVintages']);
Route::put('/wine/{id}', [WineController::class, 'update']);
Route::get('/wine/{id}/wine-vintages', [WineVintageController::class, 'getAllByWineId']);
Route::get('/wine/{id}/vintage/{vintage}', [WineVintageController::class, 'getOne']);
Route::get('/wines', [WineController::class, 'getAll']);
Route::post('/wine-comment', [WineCommentController::class, 'create']);
Route::get('/wine-comment/{id}', [WineCommentController::class, 'getById']);
Route::put('/wine-comment/{id}', [WineCommentController::class, 'update']);
Route::post('/wine-comment/{id}/wine-vintage', [WineVintageController::class, 'createAndLinkComment']);
Route::put('/wine-comment/{id}/link-wine-vintage', [WineCommentController::class, 'linkWineVintage']);
Route::post('/wine-ranking', [WineRankingController::class, 'create']);
Route::get('/wine-rankings', [WineRankingController::class, 'get']);
Route::get('/wine-types', [WineTypeController::class, 'getAll']);
Route::post('/wine-vintage', [WineVintageController::class, 'create']);
Route::get('/wine-vintages/not-registered-raking', [WineVintageController::class, 'getNotRegisteredRanking']);
Route::get('/wine-vintage/{id}', [WineVintageController::class, 'getById']);
Route::put('/wine-vintage/{id}', [WineVintageController::class, 'update']);
Route::get('/wine-vintage/{id}/wine-comments', [WineVintageController::class, 'getWineComments']);
