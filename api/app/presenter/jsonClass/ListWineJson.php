<?php

namespace App\presenter\jsonClass;

class ListWineJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ProducerJson $producer,
        public readonly WineTypeJson $wineType,
        public readonly CountryJson $country,
        public readonly ?AppellationJson $appellation,
        public readonly ?string $imagePath,
    )
    {
    }
}
