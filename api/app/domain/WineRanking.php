<?php

namespace App\domain;

class WineRanking
{
    public function __construct(
        private readonly ?int $id,
        private readonly int $rank,
        private readonly WineType $wineType,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getWineType(): WineType
    {
        return $this->wineType;
    }
}
