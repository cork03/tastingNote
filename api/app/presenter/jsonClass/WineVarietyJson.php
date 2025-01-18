<?php

namespace App\presenter\jsonClass;

class WineVarietyJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $percentage
    )
    {
    }
}
