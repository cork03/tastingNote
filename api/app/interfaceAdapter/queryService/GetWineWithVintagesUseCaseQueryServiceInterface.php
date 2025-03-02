<?php

namespace App\interfaceAdapter\queryService;

use App\usecase\wine\GetWineWithVintagesUseCase\WineInfoDTO;

interface GetWineWithVintagesUseCaseQueryServiceInterface
{
    public function getWineWithVintagesById(int $wineId): WineInfoDTO;
}
