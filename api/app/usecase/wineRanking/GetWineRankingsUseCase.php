<?php

namespace App\usecase\wineRanking;

use App\domain\Wine;
use App\domain\WineRanking;
use App\domain\WineType;
use App\domain\WineVintage;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\wineRanking\WineRankingRepositoryInterface;

class GetWineRankingsUseCase implements GetWineRankingsUseCaseInterface
{
    public function __construct(
        private readonly WineRankingRepositoryInterface $wineRankingRepository,
        private readonly FileUploaderInterface $fileUploader
    )
    {
    }

    /**
     * @return array<array{wineRank: WineRanking, wineVintage: WineVintage, imagePath: string, wine: Wine}>
     */
    public function handle(WineType $wineType): array
    {
        $wineRanksInfo = $this->wineRankingRepository->get($wineType);
        $wineRanksInfoWithImagePath = [];
        foreach ($wineRanksInfo as $wineRankInfo) {
            $wineRank = $wineRankInfo['wineRank'];
            $wineVintage = $wineRankInfo['wineVintage'];
            $wine = $wineRankInfo['wine'];
            if ($wineVintage->getImagePath() === null) {
                $wineRanksInfoWithImagePath[] = [
                    'wineRank' => $wineRank,
                    'wineVintage' => $wineVintage,
                    'imagePath' => null,
                    'wine' => $wine
                ];
            } else {
                $wineRanksInfoWithImagePath[] = [
                    'wineRank' => $wineRank,
                    'wineVintage' => $wineVintage,
                    'imagePath' => $this->fileUploader->getUrl($wineVintage->getImagePath()),
                    'wine' => $wine
                ];
            }
        }
        return $wineRanksInfoWithImagePath;
    }
}
