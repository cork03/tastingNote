<?php

namespace App\domain;


class Wine
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly int $producer_id,
        private readonly WineType $wineType
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
        return $this->producer_id;
    }

    public function getWineType(): WineType
    {
        return $this->wineType;
    }
}
