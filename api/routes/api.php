<?php

use App\Http\Controllers\ProducerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/producer', [ProducerController::class, 'create']);
Route::get('/producers', [ProducerController::class, 'getAll']);
