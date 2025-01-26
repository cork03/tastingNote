<?php

namespace App\presenter;

use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineFullInfo;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\ProducerJson;
use App\presenter\jsonClass\WineFullInfoJson;
use App\presenter\jsonClass\WineTypeJson;
use App\presenter\jsonClass\WineVarietyJson;
use App\presenter\jsonClass\WineVintageJson;
use App\presenter\jsonClass\WineWithProducerJson;
use Illuminate\Http\JsonResponse;

class WinePresenter
{
    /**
     * @param array<array{producer: Producer, wine: Wine}> $winesWithProducer
     */
    public function getWinesResponse(array $winesWithProducer): JsonResponse
    {
        $winesWithProducerJson = [];
        foreach ($winesWithProducer as $wineWithProducer) {
            $wine = $wineWithProducer['wine'];
            $producer = $wineWithProducer['producer'];
            $winesWithProducerJson[] = new WineWithProducerJson(
                id: $wine->getId(),
                name: $wine->getName(),
                producer: new ProducerJson(
                    id: $producer->getId(),
                    name: $producer->getName(),
                ),
                wineType: new WineTypeJson(
                    id: $wine->getWineType()->value,
                    label: $wine->getWineType()->getLabel(),
                ),
                country: new CountryJson(
                    id: $wine->getCountry()->getId(),
                    name: $wine->getCountry()->getName(),
                )
            );
        }
        return response()->json($winesWithProducerJson);
    }

    public function getWineWithVintagesResponse(WineFullInfo $wineFullInfo): JsonResponse
    {
        $wineVintagesJson = [];
        foreach ($wineFullInfo->getWineVintages() as $wineVintage) {
            $wineVintagesJson[] = new WineVintageJson(
                id: $wineVintage->getId(),
                wineId: $wineVintage->getWineId(),
                vintage: $wineVintage->getVintage(),
                price: $wineVintage->getPrice(),
                agingMethod: $wineVintage->getAgingMethod(),
                alcoholContent: $wineVintage->getAlcoholContent(),
                wineBlend: array_map(
                    fn($wineVariety) => new WineVarietyJson(
                        name: $wineVariety->getGrapeVariety()->getName(),
                        percentage: $wineVariety->getPercentage(),
                        id: $wineVariety->getGrapeVariety()->getId(),
                    ),
                    $wineVintage->getWineBlend()->getWineVarieties()
                ),
                technicalComment: $wineVintage->getTechnicalComment()
            );
        }
        $wine = $wineFullInfo->getWine();
        $producer = $wineFullInfo->getProducer();
        $wineType = $wine->getWineType();
        $country = $wine->getCountry();
        $wineFullInfoJson = new WineFullInfoJson(
            id: $wine->getId(),
            name: $wine->getName(),
            producer: new ProducerJson(
                id: $producer->getId(),
                name: $producer->getName(),
            ),
            wineType: new WineTypeJson(
                id: $wineType->value,
                label: $wineType->getLabel(),
            ),
            country: new CountryJson(
                id: $country->getId(),
                name: $country->getName(),
            ),
            wineVintages: $wineVintagesJson
        );
        return response()->json($wineFullInfoJson);
    }
}
