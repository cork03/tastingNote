<?php

namespace App\Http\Controllers;

use App\presenter\AppellationPresenter;
use App\usecase\appellation\AppellationCreateUseCaseInput;
use App\usecase\appellation\AppellationCreateUseCaseInterface;
use App\usecase\appellation\GetAppellationsUseCaseInterface;
use App\usecase\appellation\GetAppellationTypesUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AppellationController extends Controller
{
    public function __construct(
        private readonly AppellationCreateUseCaseInterface $appellationCreateUseCase,
        private readonly GetAppellationTypesUseCaseInterface $getAppellationTypesUseCase,
        private readonly GetAppellationsUseCaseInterface $getAppellationsUseCase,
        private readonly AppellationPresenter $presenter,
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $appellationType = $request->input('appellationType');
            $this->appellationCreateUseCase->handle(
                new AppellationCreateUseCaseInput(
                    name: $request->input('name'),
                    regulation: $request->input('regulation'),
                    appellationTypeId: $appellationType['id'],
                    appellationTypeName: $appellationType['name'],
                    countryId: $appellationType['countryId']
                )
            );
            return response()->json(status: 201);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(status: 404);
        }
    }

    public function getAll(): JsonResponse
    {
        $appellations = $this->getAppellationsUseCase->handle();
        return $this->presenter->getAppellationsResponse($appellations);
    }

    public function getTypes(): JsonResponse
    {
        $appellationTypes = $this->getAppellationTypesUseCase->handle();
        return $this->presenter->getAppellationTypesResponse($appellationTypes);
    }
}
