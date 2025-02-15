<?php

namespace App\gateways\repository\wineRanking;

use App\domain\Wine;
use App\domain\WineRanking;
use App\domain\WineType;
use App\domain\WineVintage;

interface WineRankingRepositoryInterface
{

    public function create(int $wineVintageId, int $rank, WineType $wineType): void;

    /**
     * @return array<array{wineRank: WineRanking, wineVintage: WineVintage, wine: Wine}>
     */
    public function get(WineType $wineType): array;

    /**
     * @return WineRanking[]
     */
    public function getAll(): array;
}
