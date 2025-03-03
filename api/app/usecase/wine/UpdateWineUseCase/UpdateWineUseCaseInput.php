<?php

namespace App\usecase\wine\UpdateWineUseCase;

class UpdateWineUseCaseInput
{
    public function __construct(
        private readonly int    $id,
        private readonly int    $producerId,
        private readonly string $name,
        private readonly int    $wineTypeId,
        private readonly int    $countryId,
        private readonly ?int   $appellationId = null,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
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
