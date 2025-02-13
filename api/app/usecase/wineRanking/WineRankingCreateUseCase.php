<?php

namespace App\usecase\wineRanking;

use App\domain\WineType;
use App\gateways\repository\wineRanking\WineRankingRepositoryInterface;

class WineRankingCreateUseCase implements WineRankingCreateUseCaseInterface
{
    public function __construct(private readonly WineRankingRepositoryInterface $wineRankingRepository)
    {
    }

    public function handle(int $wineVintageId, int $rank, WineType $wineType): void
    {
        $this->wineRankingRepository->create($wineVintageId, $rank, $wineType);
    }
}
