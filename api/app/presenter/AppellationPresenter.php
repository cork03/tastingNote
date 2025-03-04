<?php

namespace App\presenter;

use App\presenter\jsonClass\AppellationJson;
use App\presenter\jsonClass\AppellationTypeJson;
use App\presenter\jsonClass\CountryJson;
use App\usecase\appellation\GetAppellationsUsecase\GetAppellationsUseCaseDTO;
use App\usecase\appellation\GetAppellationTypesUseCase\GetAppellationTypesUseCaseDTO;
use Illuminate\Http\JsonResponse;

class AppellationPresenter
{
    /**
     * @param GetAppellationTypesUseCaseDTO[] $appellationTypes
     */
    public function getAppellationTypesResponse(array $appellationTypes): JsonResponse
    {
        $appellationTypesJson = [];
        foreach ($appellationTypes as $appellationType) {
            $appellationTypesJson[] = new AppellationTypeJson(
                id: $appellationType->getId(),
                name: $appellationType->getName(),
                country: new CountryJson(
                    id: $appellationType->getCountryId(),
                    name: $appellationType->getCountryName()
                )
            );
        }
        return response()->json($appellationTypesJson);
    }

    /**
     * @param GetAppellationsUseCaseDTO[] $appellations
     */
    public function getAppellationsResponse(array $appellations): JsonResponse
    {
        $appellationsJson = [];
        foreach ($appellations as $appellation) {
            $appellationsJson[] = new AppellationJson(
                id: $appellation->getId(),
                name: $appellation->getName(),
                regulation: $appellation->getRegulation(),
                appellationType: new AppellationTypeJson(
                    id: $appellation->getAppellationTypeId(),
                    name: $appellation->getAppellationTypeName(),
                    country: new CountryJson(
                        id: $appellation->getCountryId(),
                        name: $appellation->getCountryName()
                    )
                )
            );
        }
        return response()->json($appellationsJson);
    }
}
