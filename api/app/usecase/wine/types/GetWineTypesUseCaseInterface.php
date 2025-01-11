<?php

namespace App\usecase\wine\types;

use App\domain\WineType;

interface GetWineTypesUseCaseInterface
{

    /**
     * @return WineType[]
     */
    public function handle(): array;
}
