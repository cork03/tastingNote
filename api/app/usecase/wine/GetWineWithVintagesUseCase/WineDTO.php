<?php

namespace App\usecase\wine\GetWineWithVintagesUseCase;


use App\usecase\commonDTO\AppellationDTO;
use App\usecase\commonDTO\CountryDTO;
use App\usecase\commonDTO\WineTypeDTO;

class WineDTO
{
    /**
     * @param WineVintageDTO[] $vineVintages
     */
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly int $producerId,
        private readonly WineTypeDTO $wineType,
        private readonly CountryDTO $country,
        private readonly array $vineVintages,
        private readonly ?AppellationDTO $appellation,
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

    public function getWineType(): WineTypeDTO
    {
        return $this->wineType;
    }

    public function getCountry(): CountryDTO
    {
        return $this->country;
    }

    public function getVineVintages(): array
    {
        return $this->vineVintages;
    }

    public function getAppellation(): ?AppellationDTO
    {
        return $this->appellation;
    }
}
