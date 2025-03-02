<?php

namespace App\presenter\jsonClass;

class WineDetailJson
{
    public function __construct(
        public readonly ProducerJson         $producer,
        public readonly WineWithVintagesJson $wine,
    )
    {
    }
}
