<?php

namespace App\usecase\wineRanking;

use App\gateways\repository\wineRanking\WineRankingRepositoryInterface;

class WineRankingCreateUseCase implements WineRankingCreateUseCaseInterface
{
    public function __construct(private readonly WineRankingRepositoryInterface $wineRankingRepository)
    {
    }

    public function handle(int $wineVintageId, int $rank): void
    {
        $this->wineRankingRepository->create($wineVintageId, $rank);
    }
}
