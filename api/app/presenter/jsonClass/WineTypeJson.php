<?php

namespace App\presenter\jsonClass;

class WineTypeJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $label
    )
    {
    }
}
