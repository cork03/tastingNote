<?php

namespace App\usecase\wineRanking;

interface WineRankingCreateUseCaseInterface
{
    public function handle(int $wineVintageId, int $rank): void;
}
