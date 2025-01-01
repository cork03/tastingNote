<?php

namespace App\presenter\jsonClass;

class GrapeVarietyJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    )
    {
    }
}
