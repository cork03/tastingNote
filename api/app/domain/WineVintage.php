<?php

namespace App\domain;

class WineVintage
{
    /**
     * @param int[] $grapeVarieties
     */
    public function __construct(
        private readonly ?int    $id,
        private readonly int     $wineId,
        private readonly int     $vintage,
        private readonly int     $price,
        private readonly string  $agingMethod,
        private readonly float   $alcoholContent,
        private readonly array   $grapeVarieties,
        private readonly ?string $technicalComment
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWineId(): int
    {
        return $this->wineId;
    }

    public function getVintage(): int
    {
        return $this->vintage;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAgingMethod(): string
    {
        return $this->agingMethod;
    }

    public function getAlcoholContent(): float
    {
        return $this->alcoholContent;
    }

    /**
     * @return int[]
     */
    public function getGrapeVarieties(): array
    {
        return $this->grapeVarieties;
    }

    public function getTechnicalComment(): ?string
    {
        return $this->technicalComment;
    }
}
