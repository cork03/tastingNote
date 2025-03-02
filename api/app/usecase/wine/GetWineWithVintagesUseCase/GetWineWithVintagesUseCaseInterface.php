<?php

namespace App\usecase\wine\GetWineWithVintagesUseCase;

interface GetWineWithVintagesUseCaseInterface
{
    public function handle(int $wineId): WineInfoDTO;
}
