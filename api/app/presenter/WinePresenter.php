<?php

namespace App\presenter;

use App\domain\Producer;
use App\domain\Wine;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\WineTypeJson;
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
            $winesWithProducerJson[] = new WineWithProducerJson(
                id: $wine->getId(),
                name: $wine->getName(),
                producer: $wineWithProducer['producer'],
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
}
