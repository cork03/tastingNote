<?php

namespace App\gateways\repository\wine\wineTypes;

use App\domain\WineType;

interface WineTypesRepositoryInterface
{
    /**
     * @return WineType[]
     */
    public function getAll(): array;
}
