<?php

namespace App\presenter\creator;

use App\domain\WineRanking;
use App\presenter\jsonClass\WineRankingJson;
use App\presenter\jsonClass\WineTypeJson;

class WineRankingJsonCreator
{
    public function create(WineRanking $wineRanking): WineRankingJson
    {
        return new WineRankingJson(
            id: $wineRanking->getId(),
            rank: $wineRanking->getRank(),
            wineVintageId: $wineRanking->getWineVintageId(),
            wineType: new WineTypeJson(
                $wineRanking->getWineType()->value,
                $wineRanking->getWineType()->getLabel(),
            ),
        );
    }
}
