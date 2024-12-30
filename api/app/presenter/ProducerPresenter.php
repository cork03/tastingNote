<?php

namespace App\presenter;

use App\domain\Producer;
use App\presenter\jsonClass\ProducerJson;
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
            $producersJson[] = new ProducerJson(
                $producer->getId(),
                $producer->getName()
            );
        }
        return response()->json($producersJson);
    }
}
