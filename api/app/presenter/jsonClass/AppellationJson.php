<?php

namespace App\presenter\jsonClass;

class AppellationJson
{

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $regulation,
        public readonly AppellationTypeJson $appellationType,
    )
    {
    }
}
