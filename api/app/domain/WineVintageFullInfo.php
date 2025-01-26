<?php

namespace App\domain;

class WineVintageFullInfo
{
    public function __construct(
        private readonly ?int    $id,
        private readonly Wine     $wine,
        private readonly Producer $producer,
        private readonly int     $vintage,
        private readonly int     $price,
        private readonly string  $agingMethod,
        private readonly float   $alcoholContent,
        private readonly WineBlend $wineBlend,
        private readonly ?string $technicalComment
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWine(): Wine
    {
        return $this->wine;
    }

    public function getProducer(): Producer
    {
        return $this->producer;
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

    public function getWineBlend(): WineBlend
    {
        return $this->wineBlend;
    }
    public function getTechnicalComment(): ?string
    {
        return $this->technicalComment;
    }
}
