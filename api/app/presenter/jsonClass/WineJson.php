<?php

namespace App\presenter\jsonClass;

class WineJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $producerId,
        public readonly WineTypeJson $wineType
    )
    {
    }
}
