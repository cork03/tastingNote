<?php

namespace App\Http\Controllers;

use App\presenter\GrapeVarietyPresenter;
use App\usecase\grapeVariety\GetGrapeVarietiesUseCaseInterface;
use Illuminate\Http\JsonResponse;

class GrapeVarietyController extends Controller
{
    public function __construct(
        private readonly GetGrapeVarietiesUseCaseInterface $getGrapeVarietiesUseCase,
        private readonly GrapeVarietyPresenter $grapeVarietyPresenter
    )
    {
    }


    public function getAll(): JsonResponse
    {
        $grapeVarieties = $this->getGrapeVarietiesUseCase->handle();
        return $this->grapeVarietyPresenter->getGrapeVarietiesResponse($grapeVarieties);
    }
}
