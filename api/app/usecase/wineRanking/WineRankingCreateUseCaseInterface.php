<?php

namespace App\usecase\wineRanking;

use App\domain\WineType;

interface WineRankingCreateUseCaseInterface
{
    public function handle(int $wineVintageId, int $rank, WineType $wineType): void;
}
