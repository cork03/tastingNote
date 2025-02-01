<?php

namespace App\gateways\repository;

use App\domain\Country;
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
                'name' => $producer->getName(),
                'country_id' => $producer->getCountry()->getId(),
                'description' => $producer->getDescription(),
                'url' => $producer->getUrl(),
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
            $producerEntities =  $this->producerModel->with('country')->get();
            $producers = [];
            foreach ($producerEntities as $producerEntity) {
                $producers[] = new Producer(
                    id: $producerEntity->id,
                    name: $producerEntity->name,
                    country: new Country(
                        id: $producerEntity->country->id, name: $producerEntity->country->name
                    ),
                    description: $producerEntity->description,
                    url: $producerEntity->url
                );
            }
            return $producers;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }

    public function getOneById(int $producerId): ?Producer
    {
        /** @var ProducerModel $producerModel */
        $producerModel = $this->producerModel->with('country')->find($producerId);
        if (!isset($producerModel)) {
            return null;
        }
        return new Producer(
            id: $producerModel->id,
            name: $producerModel->name,
            country: new Country(
                id: $producerModel->country->id,
                name: $producerModel->country->name
            ),
            description: $producerModel->description,
            url: $producerModel->url
        );
    }

    /**
     * @return Wine[]
     * @throws Exception
     */
    public function getWines(int $producerId): array
    {
        $producer = $this->producerModel->with(['wines.country'])->find($producerId);
        if (!isset($producer)) {
            return [];
        }
        $wines = [];
        foreach ($producer->wines as $wineEntity) {
            $wines[] = new Wine(
                id :$wineEntity->id,
                name: $wineEntity->name,
                producerId: $wineEntity->producer_id,
                wineType: WineType::fromId($wineEntity->wine_type_id),
                country: new Country($wineEntity->country->id, $wineEntity->country->name)
            );
        }

        return $wines;
    }
}
