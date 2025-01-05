<?php

namespace App\presenter\jsonClass;

class CountryJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    )
    {
    }
}
