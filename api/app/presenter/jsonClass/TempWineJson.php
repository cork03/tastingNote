<?php

namespace App\presenter\jsonClass;

class TempWineJson
{
    public function __construct(
        public readonly int             $id,
        public readonly string          $name,
        public readonly int             $producerId,
        public readonly OldWineTypeJson $wineType,
        public readonly CountryJson     $country
    )
    {
    }
}
