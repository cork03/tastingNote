<?php

namespace App\usecase\appellation\GetAppellationTypesUseCase;

class GetAppellationTypesUseCaseDTO
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly int $countryId,
        private readonly string $countryName,
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

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getCountryName(): string
    {
        return $this->countryName;
    }
}
