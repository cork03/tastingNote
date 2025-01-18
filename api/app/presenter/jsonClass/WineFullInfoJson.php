<?php

namespace App\presenter\jsonClass;

use App\domain\Producer;

class WineFullInfoJson
{
    /**
     * @param WineVintageJson $wineVintages
     */
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ProducerJson $producer,
        public readonly WineTypeJson $wineType,
        public readonly CountryJson $country,
        public readonly array $wineVintages
    )
    {
    }
}
