<?php

namespace App\domain;

class WineVariety
{
    public function __construct(
        private readonly GrapeVariety $grapeVariety,
        private readonly int          $percentage,
    )
    {
    }

    public function getGrapeVariety(): GrapeVariety
    {
        return $this->grapeVariety;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }
}
