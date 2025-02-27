<?php

namespace App\presenter\jsonClass;

class WineWithProducerJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ProducerJson $producer,
        public readonly WineTypeJson $wineType,
        public readonly CountryJson $country,
        public readonly ?string $imagePath,
    )
    {
    }
}
