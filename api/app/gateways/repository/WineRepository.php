<?php

namespace App\gateways\repository;

use App\domain\Country;
use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineType;
use App\Models\Wine as WineModel;
use Exception;
use Illuminate\Support\Facades\Log;

class WineRepository implements WineRepositoryInterface
{
    public function __construct(private readonly WineModel $wineModel)
    {
    }

    /**
     * @throws Exception
     */
    public function create(Wine $wine): void
    {
        try {
            $this->wineModel->create([
                'name' => $wine->getName(),
                'producer_id' => $wine->getProducerId(),
                'wine_type_id' => $wine->getWineType()->value,
                'country_id' => $wine->getCountry()->getId(),
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }

    /**
     * @return array<array{producer: Producer, wine: Wine}>
     * @throws Exception
     */
    public function getAll(): array
    {
        $wineEntities = $this->wineModel->with(['producer', 'country'])->orderBy('country_id')->get();
        $wines = [];
        foreach ($wineEntities as $wineEntity) {
            $wines[] = [
                'producer' => new Producer(
                    id: $wineEntity->producer->id,
                    name: $wineEntity->producer->name,
                ),
                'wine' => new Wine(
                    id: $wineEntity->id,
                    name: $wineEntity->name,
                    producerId: $wineEntity->producer_id,
                    wineType: WineType::fromId($wineEntity->wine_type_id),
                    country: new Country($wineEntity->country_id, $wineEntity->country->name),
                )
            ];
        }
        return $wines;
    }
}
