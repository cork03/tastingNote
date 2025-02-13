<?php

namespace App\presenter;

use App\domain\Producer;
use App\domain\Wine;
use App\presenter\creator\ProducerJsonCreator;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\WineJson;
use App\presenter\jsonClass\WineTypeJson;
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
     * @param Wine[] $wines
     * @return JsonResponse
     */
    public function getWinesResponse(array $wines): JsonResponse
    {
        $winesJson = [];
        foreach ($wines as $wine) {
            $winesJson[] = new WineJson(
                $wine->getId(),
                $wine->getName(),
                $wine->getProducerId(),
                new WineTypeJson(
                    $wine->getWineType()->value,
                    $wine->getWineType()->getLabel()
                ),
                new CountryJson(
                    $wine->getCountry()->getId(),
                    $wine->getCountry()->getName()
                )
            );
        }
        return response()->json($winesJson);
    }
}
