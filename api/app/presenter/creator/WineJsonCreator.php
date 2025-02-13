<?php

namespace App\presenter\creator;

use App\domain\Wine;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\WineJson;
use App\presenter\jsonClass\WineTypeJson;

class WineJsonCreator
{
    public function create(Wine $wine): WineJson
    {
        return new WineJson(
            id: $wine->getId(),
            name: $wine->getName(),
            producerId: $wine->getProducerId(),
            wineType: new WineTypeJson(
                $wine->getWineType()->value,
                $wine->getWineType()->getLabel(),
            ),
            country: new CountryJson(
                $wine->getCountry()->getId(),
                $wine->getCountry()->getName(),
            )
        );
    }
}
