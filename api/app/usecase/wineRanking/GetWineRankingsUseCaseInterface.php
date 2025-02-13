<?php

namespace App\usecase\wineRanking;

use App\domain\WineRanking;
use App\domain\WineType;
use App\domain\WineVintage;

interface GetWineRankingsUseCaseInterface
{
    /**
     * @return array<array{wineRank: WineRanking, wineVintage: WineVintage, imagePath: string}>
     */
    public function handle(WineType $wineType): array;
}
