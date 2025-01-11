<?php

namespace App\Http\Controllers;

use App\presenter\WineTypePresenter;
use App\usecase\wine\types\GetWineTypesUseCaseInterface;
use Illuminate\Http\JsonResponse;

class WineTypeController extends Controller
{
    public function __construct(
        private readonly GetWineTypesUseCaseInterface $getWineTypesUseCase,
        private readonly WineTypePresenter $wineTypePresenter
    )
    {

    }

    public function getAll(): JsonResponse
    {
        $wineTypes = $this->getWineTypesUseCase->handle();
        return $this->wineTypePresenter->getWineTypeResponse($wineTypes);
    }
}
