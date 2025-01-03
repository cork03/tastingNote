<?php

namespace App\presenter;

use App\domain\Producer;
use App\domain\Wine;
use App\presenter\jsonClass\ProducerJson;
use App\presenter\jsonClass\WineJson;
use Illuminate\Http\JsonResponse;
use Psy\Util\Json;

class ProducerPresenter
{
    /**
     * @param Producer[] $producers
     */
    public function getProducersResponse(array $producers): JsonResponse
    {
        $producersJson = [];
        foreach ($producers as $producer) {
            $producersJson[] = new ProducerJson(
                $producer->getId(),
                $producer->getName()
            );
        }
        return response()->json($producersJson);
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
                $wine->getWineType()->value,
            );
        }
        return response()->json($winesJson);
    }
}
