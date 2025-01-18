<?php

namespace App\Http\Controllers;

use App\domain\Country;
use App\domain\GrapeVariety;
use App\domain\Wine;
use App\domain\WineBlend;
use App\domain\WineType;
use App\domain\WineVariety;
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
        Log::info($request->input('wineVintage'));
        try {
            $wineVintage = $request->input('wineVintage');
            $wineVarieties = [];
            foreach ($wineVintage['wineBlend'] as $wineVariety) {
                $wineVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $wineVariety['grapeVarietyId'],
                        name: null
                    ),
                    percent: $wineVariety['percent'],
                );
            }
            $this->createWineVintageUseCase->handle(
                new CreateWineVintageUseCaseInput(
                    new WineVintage(
                        id: null,
                        wineId: $wineVintage['wineId'],
                        vintage: $wineVintage['vintage'],
                        price: $wineVintage['price'],
                        agingMethod: $wineVintage['agingMethod'],
                        alcoholContent: $wineVintage['alcoholContent'],
                        wineBlend: new WineBlend($wineVarieties),
                        technicalComment: $wineVintage['technicalComment']
                    )
                )
            );
            return response()->json(status: 201);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400, data: $e->getMessage());
        }
    }
}
