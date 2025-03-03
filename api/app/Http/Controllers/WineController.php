<?php

namespace App\Http\Controllers;

use App\presenter\WinePresenter;
use App\usecase\wine\CreateWineUseCase\CreateWineUseCaseInput;
use App\usecase\wine\CreateWineUseCase\CreateWineUseCaseInterface;
use App\usecase\wine\GetWineUseCase\GetWinesUseCaseInterface;
use App\usecase\wine\GetWineWithVintagesUseCase\GetWineWithVintagesUseCaseInterface;
use App\usecase\wine\UpdateWineUseCase\UpdateWineUseCaseInput;
use App\usecase\wine\UpdateWineUseCase\UpdateWineUseCaseInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WineController extends Controller
{
    public function __construct(
        private readonly CreateWineUseCaseInterface          $createWineUseCase,
        private readonly UpdateWineUseCaseInterface          $updateWineUseCase,
        private readonly GetWinesUseCaseInterface            $getWinesUseCase,
        private readonly GetWineWithVintagesUseCaseInterface $getWineWithVintagesUseCase,
        private readonly WinePresenter                       $presenter
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $wine = $this->createWineUseCase->handle(
                new CreateWineUseCaseInput(
                    producerId: $request->input('producerId'),
                    name: $request->input('name'),
                    wineTypeId: $request->input('wineTypeId'),
                    countryId: $request->input('countryId'),
                    appellationId: $request->input('appellationId')
                )
            );
            return response()->json(['id' => $wine->getId()], 201);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $this->updateWineUseCase->handle(
                new UpdateWineUseCaseInput(
                    id: $id,
                    producerId: $request->input('producerId'),
                    name: $request->input('name'),
                    wineTypeId: $request->input('wineTypeId'),
                    countryId: $request->input('countryId'),
                    appellationId: $request->input('appellationId')
                )
            );
            return response()->json();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 400);
        }
    }

    public function getAll(): JsonResponse
    {
        $wineDTOs = $this->getWinesUseCase->handle();
        return $this->presenter->getWinesResponse($wineDTOs);
    }

    public function getWithVintages(int $id): JsonResponse
    {
        $wineWithVintages = $this->getWineWithVintagesUseCase->handle($id);
        return $this->presenter->getWineWithVintagesResponse($wineWithVintages);
    }
}
