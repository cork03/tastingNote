<?php

namespace App\presenter\jsonClass;

class WineJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $producer_id,
        public readonly int $wine_type_id
    )
    {
    }
}
