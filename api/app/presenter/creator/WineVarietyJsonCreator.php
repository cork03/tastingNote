<?php

namespace App\presenter\creator;

use App\domain\WineVariety;
use App\presenter\jsonClass\WineVarietyJson;

class WineVarietyJsonCreator
{
    public function create(WineVariety $wineVariety): WineVarietyJson
    {
        return new WineVarietyJson(
            name: $wineVariety->getGrapeVariety()->getName(),
            percentage: $wineVariety->getPercentage(),
            id: $wineVariety->getGrapeVariety()->getId()
        );
    }
}
