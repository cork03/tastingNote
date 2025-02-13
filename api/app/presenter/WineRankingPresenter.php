<?php

namespace App\presenter;

use App\domain\Wine;
use App\domain\WineRanking;
use App\domain\WineVintage;
use App\presenter\creator\WineJsonCreator;
use App\presenter\creator\WineRankingJsonCreator;
use App\presenter\creator\WineVintageJsonCreator;
use App\presenter\jsonClass\WineRankingFullInfoJson;
use Illuminate\Http\JsonResponse;

class WineRankingPresenter
{
    /**
     * @param array<array{wineRank: WineRanking, wineVintage: WineVintage, imagePath: string, wine: Wine}> $ranksInfo
     */
    public function getResponse(array $ranksInfo): JsonResponse
    {
        $wineRanksFullInfoJson = [];
        foreach ($ranksInfo as $rankInfo) {
            $wineRanksFullInfoJson[] = new WineRankingFullInfoJson(
                wineRanking: (new WineRankingJsonCreator())->create($rankInfo['wineRank']),
                wineVintage: (new WineVintageJsonCreator())
                    ->create($rankInfo['wineVintage'], $rankInfo['imagePath']),
                wine: (new WineJsonCreator())->create($rankInfo['wine']),
            );
        }
        return response()->json($wineRanksFullInfoJson);
    }
}
