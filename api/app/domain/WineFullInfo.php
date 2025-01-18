<?php

namespace App\domain;

class WineFullInfo
{
    /**
     * @param WineVintage[] $wineVintages
     */
    public function __construct(
        private readonly Wine $wine,
        private readonly Producer $producer,
        private readonly array $wineVintages
    )
    {
    }

    public function getWine(): Wine
    {
        return $this->wine;
    }

    public function getProducer(): Producer
    {
        return $this->producer;
    }

    /**
     * @return WineVintage[]
     */
    public function getWineVintages(): array
    {
        return $this->wineVintages;
    }
}
