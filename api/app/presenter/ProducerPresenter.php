<?php

namespace App\presenter;

use App\domain\Producer;
use App\domain\Wine;
use App\presenter\creator\ProducerJsonCreator;
use App\presenter\jsonClass\AppellationJson;
use App\presenter\jsonClass\AppellationTypeJson;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\ProducerWineJson;
use App\presenter\jsonClass\TempWineJson;
use App\presenter\jsonClass\WineTypeJson;
use App\usecase\producer\GetProducerWinesUseCase\ProducerWineWithImagePathDTO;
use Illuminate\Http\JsonResponse;

class ProducerPresenter
{
    /**
     * @param Producer[] $producers
     */
    public function getProducersResponse(array $producers): JsonResponse
    {
        $producersJson = [];
        foreach ($producers as $producer) {
            $producersJson[] = (new ProducerJsonCreator())->create($producer);
        }
        return response()->json($producersJson);
    }

    public function getProducerResponse(Producer $producer): JsonResponse
    {
        return response()->json((new ProducerJsonCreator())->create($producer));
    }

    /**
     * @param ProducerWineWithImagePathDTO[] $producerWines
     */
    public function getWinesResponse(array $producerWines): JsonResponse
    {
        $producerWinesJson = [];
        foreach ($producerWines as $producerWine) {
            $country = new CountryJson(
                id: $producerWine->getCountry()->getId(),
                name: $producerWine->getCountry()->getName()
            );
            $appellation = null;
            if ($producerWine->getAppellation() !== null) {
                $appellation = new AppellationJson(
                    id: $producerWine->getAppellation()->getId(),
                    name: $producerWine->getAppellation()->getName(),
                    regulation: $producerWine->getAppellation()->getRegulation(),
                    appellationType: new AppellationTypeJson(
                        id: $producerWine->getAppellation()->getAppellationType()->getId(),
                        name: $producerWine->getAppellation()->getAppellationType()->getName(),
                        country: $country
                    )
                );
            }
            $producerWinesJson[] = new ProducerWineJson(
                id: $producerWine->getId(),
                name: $producerWine->getName(),
                producerId: $producerWine->getProducerId(),
                wineType: new WineTypeJson(
                    id: $producerWine->getWineType()->getId(),
                    label: $producerWine->getWineType()->getName()
                ),
                country: $country,
                appellation: $appellation,
                imagePath: $producerWine->getImagePath()
            );
        }
        return response()->json($producerWinesJson);
    }
}
