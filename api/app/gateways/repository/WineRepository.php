<?php

namespace App\gateways\repository;

use App\domain\Aggregate\Wine;
use App\interfaceAdapter\repository\WineRepositoryInterface;
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
    public function create(Wine $wine): Wine
    {
        try {
            $wineModel = $this->wineModel->create([
                'name' => $wine->getName(),
                'producer_id' => $wine->getProducerId(),
                'wine_type_id' => $wine->getWineTypeId(),
                'country_id' => $wine->getCountryId(),
                'appellation_id' => $wine->getAppellationId()
            ]);
            return new Wine(
                id: $wineModel->id,
                name: $wineModel->name,
                producerId: $wineModel->producer_id,
                wineTypeId: $wineModel->wine_type_id,
                countryId: $wineModel->country_id,
                appellationId: $wineModel->appellation_id
            );
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function update(Wine $wine): void
    {
        try {
            /** @var WineModel $wineModel */
            $wineModel = $this->wineModel->find($wine->getId());
            if ($wineModel === null) {
                throw new Exception('Wine not found');
            }
            $wineModel->update([
                'name' => $wine->getName(),
                'producer_id' => $wine->getProducerId(),
                'wine_type_id' => $wine->getWineTypeId(),
                'country_id' => $wine->getCountryId(),
                'appellation_id' => $wine->getAppellationId()
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }

    }
}
