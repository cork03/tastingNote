<?php

namespace App\presenter\jsonClass;

class ProducerJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly CountryJson $country,
        public readonly string $description,
        public readonly ?string $url,
    )
    {
    }
}
