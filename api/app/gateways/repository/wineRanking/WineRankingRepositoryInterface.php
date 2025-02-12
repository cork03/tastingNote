<?php

namespace App\gateways\repository\wineRanking;

interface WineRankingRepositoryInterface
{

    public function create(int $wineVintageId, int $rank): void;
}
