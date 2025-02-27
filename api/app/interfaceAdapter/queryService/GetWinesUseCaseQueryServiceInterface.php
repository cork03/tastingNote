<?php

namespace App\interfaceAdapter\queryService;

use App\usecase\wine\GetWineUseCase\wineDTO;

interface GetWinesUseCaseQueryServiceInterface
{
    /**
     * @return wineDTO[]
     */
    public function getWines(): array;
}
