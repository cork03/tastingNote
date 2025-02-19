<?php

namespace App\presenter\jsonClass;

class AppellationTypeJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly CountryJson $country
    )
    {
    }
}
