<?php

namespace App\presenter\jsonClass;

class OldWineTypeJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $label
    )
    {
    }
}
