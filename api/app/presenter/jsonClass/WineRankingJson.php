<?php

namespace App\presenter\jsonClass;

class WineRankingJson
{
    public function __construct(
        public readonly int             $id,
        public readonly int             $rank,
        public readonly int             $wineVintageId,
        public readonly OldWineTypeJson $wineType,
    )
    {
    }
}
