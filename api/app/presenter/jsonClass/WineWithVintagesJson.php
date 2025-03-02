<?php

namespace App\presenter\jsonClass;

class WineWithVintagesJson
{
    /**
     * @param WineVintageJson[] $wineVintages
     */
    public function __construct(
        public readonly int              $id,
        public readonly string           $name,
        public readonly int              $producerId,
        public readonly WineTypeJson  $wineType,
        public readonly CountryJson      $country,
        public readonly array            $wineVintages,
        public readonly ?AppellationJson $appellation,
    )
    {
    }
}
