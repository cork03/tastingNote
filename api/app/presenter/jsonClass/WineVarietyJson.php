<?php

namespace App\presenter\jsonClass;

class WineVarietyJson
{
    public function __construct(
        public readonly string $name,
        public readonly int $percentage,
        public readonly ?int $id = null,
    )
    {
    }
}
