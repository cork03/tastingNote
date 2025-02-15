<?php

namespace App\usecase\wineVintage;

use App\domain\Wine;
use App\domain\WineVintage;
use App\gateways\repository\wineRanking\WineRankingRepositoryInterface;
use App\gateways\repository\WineVintageRepositoryInterface;

class GetNotRegisteredRankingWineVintagesUseCase implements GetNotRegisteredRankingWineVintagesUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository,
        private readonly WineRankingRepositoryInterface $wineRankingRepository
    )
    {
    }

    /**
     * @return array<array{wine: Wine, wineVintage: WineVintage}>
     */
    public function handle(): array
    {
        // wineVintageを全件取得
        $wineVintagesInfo = $this->wineVintageRepository->getAllWithWine();
        // rankingに登録されているwineVintageを取得
        $ranking = $this->wineRankingRepository->getAll();
        $registeredWineVintageId = array_map(function ($wineRanking) {
            return $wineRanking->getWineVintageId();
        }, $ranking);
        // rankingに登録されていないwineVintageに絞り込む
        return array_filter(
            $wineVintagesInfo,
            function ($wineVintageInfo) use ($ranking, $registeredWineVintageId) {
                return !in_array($wineVintageInfo['wineVintage']->getId(), $registeredWineVintageId);
            }
        );
    }
}
