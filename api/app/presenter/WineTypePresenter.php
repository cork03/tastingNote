<?php

namespace App\presenter;

use App\domain\WineType;
use App\presenter\jsonClass\WineTypeJson;
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
            $wineTypesJson[] = new WineTypeJson(
                $wineType->value,
                $wineType->getLabel()
            );
        }
        return response()->json($wineTypesJson);
    }
}
