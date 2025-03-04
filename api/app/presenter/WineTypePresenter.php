<?php

namespace App\presenter;

use App\domain\WineType;
use App\presenter\jsonClass\OldWineTypeJson;
use Illuminate\Http\JsonResponse;

class WineTypePresenter
{
    /**
     * @param WineType[] $wineTypes
     */
    public function getWineTypeResponse(array $wineTypes): JsonResponse
    {
        $wineTypesJson = [];
        foreach ($wineTypes as $wineType) {
            $wineTypesJson[] = new OldWineTypeJson(
                $wineType->value,
                $wineType->getLabel(),
                $wineType->getLabel()
            );
        }
        return response()->json($wineTypesJson);
    }
}
