<?php

namespace App\Http\Controllers;

use App\domain\Country;
use App\domain\Wine;
use App\domain\WineType;
use App\domain\WineVintage;
use App\usecase\wine\CreateWineUseCaseInput;
use App\usecase\wine\CreateWineUseCaseInterface;
use App\usecase\wine\CreateWineVintageUseCaseInput;
use App\usecase\wine\CreateWineVintageUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WineController extends Controller
{
    public function __construct(
        private readonly CreateWineUseCaseInterface $createWineUseCase,
        private readonly CreateWineVintageUseCaseInterface $createWineVintageUseCase
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
                        producerId: $wine['producerId'],
                        wineType: WineType::fromId($wine['wineTypeId']),
                        country: new Country($wine['countryId'], null),
                    )
                )
            );
            return response()->json(status: 201);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }
    }

    public function createWineVintage(Request $request): JsonResponse
    {
        try {
            $wineVintage = $request->input('wine_vintage');
            $this->createWineVintageUseCase->handle(
                new CreateWineVintageUseCaseInput(
                    new WineVintage(
                        id: null,
                        wineId: $wineVintage['wineId'],
                        vintage: $wineVintage['vintage'],
                        price: $wineVintage['price'],
                        agingMethod: $wineVintage['agingMethod'],
                        alcoholContent: $wineVintage['alcoholContent'],
                        grapeVarieties: $wineVintage['grapeVarieties'],
                        technicalComment: $wineVintage['technicalComment']
                    )
                )
            );
            return response()->json(status: 201);
        } catch (Exception $e) {
            return response()->json(status: 400);
        }
    }
}
