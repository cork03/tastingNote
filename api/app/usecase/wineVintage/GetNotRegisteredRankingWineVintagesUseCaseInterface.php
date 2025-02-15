<?php

namespace App\usecase\wineVintage;

use App\domain\Wine;
use App\domain\WineVintage;

interface GetNotRegisteredRankingWineVintagesUseCaseInterface
{
    /**
     * @return array<array{wine: Wine, wineVintage: WineVintage}>
     */
    public function handle(): array;
}
