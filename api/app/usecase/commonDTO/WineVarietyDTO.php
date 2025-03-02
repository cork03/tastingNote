<?php

namespace App\usecase\commonDTO;

class WineVarietyDTO
{
    public function __construct(
        private readonly GrapeVarietyDTO $grapeVariety,
        private readonly int          $percentage,
    )
    {
    }

    public function getGrapeVariety(): GrapeVarietyDTO
    {
        return $this->grapeVariety;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }
}
