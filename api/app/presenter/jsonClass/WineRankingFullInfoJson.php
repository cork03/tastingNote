<?php

namespace App\presenter\jsonClass;

class WineRankingFullInfoJson
{
    public function __construct(
        public readonly WineRankingJson $wineRanking,
        public readonly WineVintageJson $wineVintage,
        public readonly WineJson $wine,
    )
    {
    }
}
