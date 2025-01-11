<?php

namespace App\domain;


class Wine
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $name,
        private readonly int $producerId,
        private readonly WineType $wineType,
        private readonly Country $country
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProducerId(): int
    {
        return $this->producerId;
    }

    public function getWineType(): WineType
    {
        return $this->wineType;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }
}
