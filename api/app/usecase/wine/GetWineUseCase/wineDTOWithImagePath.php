<?php

namespace App\usecase\wine\GetWineUseCase;

class wineDTOWithImagePath
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly int $wineTypeId,
        private readonly string $wineTypeName,
        private readonly int $countryId,
        private readonly string $countryName,
        private readonly producerDTO $producer,
        private readonly ?string $latestVintageImagePath,
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

    public function getWineTypeId(): int
    {
        return $this->wineTypeId;
    }

    public function getWineTypeName(): string
    {
        return $this->wineTypeName;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }

    public function getProducer(): producerDTO
    {
        return $this->producer;
    }

    public function getLatestVintageImagePath(): ?string
    {
        return $this->latestVintageImagePath;
    }
}
