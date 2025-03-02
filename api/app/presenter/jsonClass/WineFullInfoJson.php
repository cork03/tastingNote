<?php

namespace App\presenter\jsonClass;


class WineFullInfoJson
{
    /**
     * @param WineVintageJson $wineVintages
     */
    public function __construct(
        public readonly int             $id,
        public readonly string          $name,
        public readonly ProducerJson    $producer,
        public readonly OldWineTypeJson $wineType,
        public readonly CountryJson     $country,
        public readonly array           $wineVintages
    )
    {
    }
}
