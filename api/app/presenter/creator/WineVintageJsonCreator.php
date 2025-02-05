<?php

namespace App\presenter\creator;

use App\domain\WineVariety;
use App\domain\WineVintage;
use App\presenter\jsonClass\WineVarietyJson;
use App\presenter\jsonClass\WineVintageJson;

class WineVintageJsonCreator
{
    public function create(WineVintage $wineVintage, ?string $imagePath): WineVintageJson
    {
        return new WineVintageJson(
            id: $wineVintage->getId(),
            wineId: $wineVintage->getWineId(),
            vintage: $wineVintage->getVintage(),
            price: $wineVintage->getPrice(),
            agingMethod: $wineVintage->getAgingMethod(),
            alcoholContent: $wineVintage->getAlcoholContent(),
            wineBlend: array_map(function ($wineVariety) {
                return (new WineVarietyJsonCreator())->create($wineVariety);
            }, $wineVintage->getWineBlend()->getWineVarieties()),
            technicalComment: $wineVintage->getTechnicalComment(),
            imagePath: $imagePath
        );
    }
}
