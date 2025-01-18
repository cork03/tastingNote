<?php

namespace App\domain;

class WineVariety
{
    public function __construct(
        private readonly GrapeVariety $grapeVariety,
        private readonly int $percent,
    )
    {
    }

    public function getGrapeVariety(): GrapeVariety
    {
        return $this->grapeVariety;
    }
    public function getPercent(): int
    {
        return $this->percent;
    }
}
