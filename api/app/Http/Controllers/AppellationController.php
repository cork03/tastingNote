<?php

namespace App\Http\Controllers;

use App\domain\Appellation;
use App\domain\AppellationType;
use App\domain\Country;
use App\presenter\AppellationPresenter;
use App\usecase\appellation\AppellationCreateUseCaseInterface;
use App\usecase\appellation\GetAppellationTypesUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppellationController extends Controller
{
    public function __construct(
        private readonly AppellationCreateUseCaseInterface $appellationCreateUseCase,
        private readonly GetAppellationTypesUseCaseInterface $getAppellationTypesUseCase,
        private readonly AppellationPresenter $presenter,
    )
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $appellationType = $request->input('appellationType');
            $this->appellationCreateUseCase->handle(
                new Appellation(
                    id: null,
                    name: $request->input('name'),
                    regulation: $request->input('regulation'),
                    appellationType: new AppellationType(
                        id: $appellationType['id'],
                        name: $appellationType['name'],
                        country: new Country(
                            id: $appellationType['countryId'],
                            name: null
                        )
                    )
                )
            );
            return response()->json(status: 201);
        } catch (\Exception $e) {
            return response()->json(status: 404);
        }
    }

    public function getTypes(): JsonResponse
    {
        $appellationTypes = $this->getAppellationTypesUseCase->handle();
        return $this->presenter->getAppellationTypesResponse($appellationTypes);
    }
}
