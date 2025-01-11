<?php

namespace App\gateways\repository\wine\wineTypes;

use App\domain\WineType;
use App\Models\WineType as WineTypeModel;
use Exception;

class WineTypesRepository implements WineTypesRepositoryInterface
{
    public function __construct(private readonly WineTypeModel $wineTypeModel)
    {
    }

    /**
     * @return WineType[]
     * @throws Exception
     */
    public function getAll(): array
    {
        $wineTypeEntities = $this->wineTypeModel->get();
        $wineTypes = [];
        foreach ($wineTypeEntities as $wineTypeEntity) {
            $wineTypes[] = WineType::fromId($wineTypeEntity->id);
        }
        return $wineTypes;
    }
}
