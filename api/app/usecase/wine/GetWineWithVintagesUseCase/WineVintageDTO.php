<?php

namespace App\usecase\wine\GetWineWithVintagesUseCase;

use App\usecase\commonDTO\WineVarietyDTO;

class WineVintageDTO
{
    /**
     * @param WineVarietyDTO[] $wineBlend
     */
    public function __construct(
        private readonly int $id,
        private readonly int $wineId,
        private readonly int $vintage,
        private readonly int $price,
        private readonly string $agingMethod,
        private readonly float $alcoholContent,
        private readonly array $wineBlend,
        private readonly ?string $technicalComment,
        private readonly ?string $imagePath
    )
    {
    }

    public function getId(): int
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
     * @return WineVarietyDTO[]
     */
    public function getWineBlend(): array
    {
        return $this->wineBlend;
    }

    public function getTechnicalComment(): ?string
    {
        return $this->technicalComment;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }
}
