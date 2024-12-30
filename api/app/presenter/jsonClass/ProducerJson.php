<?php

namespace App\presenter\jsonClass;

class ProducerJson
{
    public function __construct(
        public readonly int $id,
        public readonly string $name
    )
    {
    }
}
