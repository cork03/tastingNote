<?php

namespace App\Http\Controllers;

use App\domain\Wine;
use App\domain\WineType;
use App\usecase\wine\CreateWineUseCaseInput;
use App\usecase\wine\CreateWineUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WineController extends Controller
{
    public function __construct(
        private readonly CreateWineUseCaseInterface $createWineUseCase
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $wine = $request->input('wine');
            $this->createWineUseCase->handle(
                new CreateWineUseCaseInput(
                    new Wine(
                        id: null,
                        name: $wine['name'],
                        producerId: $wine['producer_id'],
                        wineType: WineType::create($wine['wine_type_id'])
                    )));
            return response()->json(status: 201);
        } catch (Exception $e) {
            return response()->json(status: 400);
        }
    }
}
