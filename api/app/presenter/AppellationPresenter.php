<?php

namespace App\presenter;

use App\presenter\jsonClass\AppellationTypeJson;
use App\presenter\jsonClass\CountryJson;
use App\usecase\appellation\GetAppellationTypesUseCaseDTO;
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
}
