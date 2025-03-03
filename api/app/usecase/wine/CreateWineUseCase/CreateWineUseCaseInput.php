<?php

namespace App\usecase\wine\CreateWineUseCase;

class CreateWineUseCaseInput
{
    public function __construct(
        private readonly int $producerId,
        private readonly string $name,
        private readonly int $wineTypeId,
        private readonly int $countryId,
        private readonly ?int $appellationId = null,
    )
    {
    }

    public function getProducerId(): int
    {
        return $this->producerId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getWineTypeId(): int
    {
        return $this->wineTypeId;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getAppellationId(): ?int
    {
        return $this->appellationId;
    }
}
