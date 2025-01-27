<?php

namespace App\Http\Controllers;

use App\domain\GrapeVariety;
use App\domain\WineBlend;
use App\domain\WineVariety;
use App\domain\WineVintage;
use App\presenter\WineVintagePresenter;
use App\usecase\wine\CreateWineVintageUseCaseInput;
use App\usecase\wineVintage\CreateUseCaseInterface;
use App\usecase\wineVintage\GetFullInfoUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WineVintageController extends Controller
{
    public function __construct(
        private readonly CreateUseCaseInterface      $createWineVintageUseCase,
        private readonly GetFullInfoUseCaseInterface $getFullInfoUseCase,
        private readonly WineVintagePresenter        $wineVintagePresenter
    )
    {
    }

    public function create(Request $request): JsonResponse
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
                    percentage: $wineVariety['percentage'],
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
            return response()->json(data: $e->getMessage(), status: 400);
        }
    }

    public function getOne(int $wineId, int $vintage): JsonResponse
    {
        try {
            $wineVintageFullInfo = $this->getFullInfoUseCase->handle($wineId, $vintage);
            return $this->wineVintagePresenter->getFullInfoResponse($wineVintageFullInfo);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status:  404);
        }
    }
}
