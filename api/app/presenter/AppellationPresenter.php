<?php

namespace App\presenter;

use App\domain\AppellationType;
use App\presenter\creator\AppellationTypeJsonCreator;
use Illuminate\Http\JsonResponse;

class AppellationPresenter
{
    /**
     * @param AppellationType[] $appellationTypes
     */
    public function getAppellationTypesResponse(array $appellationTypes): JsonResponse
    {
        $appellationTypesJson = [];
        foreach ($appellationTypes as $appellationType) {
            $appellationTypesJson[] = (new AppellationTypeJsonCreator())->create($appellationType);
        }
        return response()->json($appellationTypesJson);
    }
}
