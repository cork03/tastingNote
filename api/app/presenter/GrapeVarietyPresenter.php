<?php

namespace App\presenter;

use App\domain\GrapeVariety;
use App\presenter\jsonClass\GrapeVarietyJson;
use Illuminate\Http\JsonResponse;

class GrapeVarietyPresenter
{
    /**
     * @param GrapeVariety[] $grapeVarieties
     */
    public function getGrapeVarietiesResponse(array $grapeVarieties): JsonResponse
    {
        $grapeVarietiesJson = [];
        foreach ($grapeVarieties as $grapeVariety) {
            $grapeVarietiesJson[] = new GrapeVarietyJson(
                $grapeVariety->getId(),
                $grapeVariety->getName()
            );
        }
        return response()->json($grapeVarietiesJson);
    }
}
