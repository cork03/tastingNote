<?php

namespace App\presenter;

use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineFullInfo;
use App\domain\WineVintageFullInfo;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\ProducerJson;
use App\presenter\jsonClass\WineFullInfoJson;
use App\presenter\jsonClass\WineJson;
use App\presenter\jsonClass\WineTypeJson;
use App\presenter\jsonClass\WineVarietyJson;
use App\presenter\jsonClass\WineVintageFullInfoJson;
use App\presenter\jsonClass\WineVintageJson;
use App\presenter\jsonClass\WineWithProducerJson;
use Illuminate\Http\JsonResponse;

class WineVintagePresenter
{
    function getFullInfoResponse(WineVintageFullInfo $wineVintageFullInfo): JsonResponse
    {
        $producer = $wineVintageFullInfo->getProducer();
        $wine = $wineVintageFullInfo->getWine();
        $wineVintageFullInfoJson = new WineVintageFullInfoJson(
            id: $wineVintageFullInfo->getId(),
            producer: new ProducerJson(
                id: $producer->getId(),
                name: $producer->getName(),
            ),
            wine: new WineJson(
                id: $wine->getId(),
                name: $wine->getName(),
                producerId: $wine->getProducerId(),
                wineType: new WineTypeJson(
                    id: $wine->getWineType()->value,
                    label: $wine->getWineType()->getLabel(),
                ),
                country: new CountryJson(
                    id: $wine->getCountry()->getId(),
                    name: $wine->getCountry()->getName(),
                )
            ),
            vintage: $wineVintageFullInfo->getVintage(),
            price: $wineVintageFullInfo->getPrice(),
            agingMethod: $wineVintageFullInfo->getAgingMethod(),
            alcoholContent: $wineVintageFullInfo->getAlcoholContent(),
            wineBlend: array_map(
                fn($wineVariety) => new WineVarietyJson(
                    name: $wineVariety->getGrapeVariety()->getName(),
                    percentage: $wineVariety->getPercentage(),
                ),
                $wineVintageFullInfo->getWineBlend()->getWineVarieties()
            ),
            technicalComment: $wineVintageFullInfo->getTechnicalComment()
        );
        return response()->json($wineVintageFullInfoJson);
    }
}
