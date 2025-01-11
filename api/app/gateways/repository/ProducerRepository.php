<?php

namespace App\gateways\repository;

use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineType;
use App\Models\Producer as ProducerModel;
use Exception;
use Illuminate\Support\Facades\Log;

class ProducerRepository implements ProducerRepositoryInterface
{
    public function __construct(private readonly ProducerModel $producerModel)
    {
    }

    /**
     * @throws Exception
     */
    public function create(Producer $producer): void
    {
        try {
            $this->producerModel->create([
                'name' => $producer->getName()
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }

    /**
     * @return Producer[]
     * @throws Exception
     */
    public function getAll(): array
    {
        try {
            $producerEntities =  $this->producerModel->get();
            $producers = [];
            foreach ($producerEntities as $producerEntity) {
                $producers[] = new Producer(
                    $producerEntity->id,
                    $producerEntity->name
                );
            }
            return $producers;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }

    /**
     * @return Wine[]
     * @throws Exception
     */
    public function getWines(int $producerId): array
    {
        $wineEntities = $this->producerModel->find($producerId)?->wines;
        if (!isset($wineEntities)) {
            return [];
        }
        $wines = [];
        foreach ($wineEntities as $wineEntity) {
            $wines[] = new Wine(
                id :$wineEntity->id,
                name: $wineEntity->name,
                producerId: $wineEntity->producer_id,
                wineType: WineType::fromId($wineEntity->wine_type_id)
            );
        }

        return $wines;
    }
}
