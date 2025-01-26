<?php

namespace App\Http\Controllers;

use App\domain\Country;
use App\domain\GrapeVariety;
use App\domain\Wine;
use App\domain\WineBlend;
use App\domain\WineType;
use App\domain\WineVariety;
use App\domain\WineVintage;
use App\presenter\WinePresenter;
use App\presenter\WineVintagePresenter;
use App\usecase\wine\CreateWineUseCaseInput;
use App\usecase\wine\CreateWineUseCaseInterface;
use App\usecase\wine\CreateWineVintageUseCaseInput;
use App\usecase\wine\CreateWineVintageUseCaseInterface;
use App\usecase\wine\GetWinesUseCaseInterface;
use App\usecase\wine\GetWineWithVintagesUseCaseInterface;
use App\usecase\wineVintage\GetFullInfoUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WineVintageController extends Controller
{
    public function __construct(
        private readonly GetFullInfoUseCaseInterface $getFullInfoUseCase,
        private readonly WineVintagePresenter $wineVintagePresenter
    )
    {
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
