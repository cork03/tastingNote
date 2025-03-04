<?php

namespace App\usecase\appellation\GetAppellationsUsecase;

class GetAppellationsUseCaseDTO
{
    public function __construct(
        private readonly int    $id,
        private readonly string $name,
        private readonly string $regulation,
        private readonly int    $appellationTypeId,
        private readonly string $appellationTypeName,
        private readonly int    $countryId,
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

    public function getRegulation(): string
    {
        return $this->regulation;
    }

    public function getAppellationTypeId(): int
    {
        return $this->appellationTypeId;
    }

    public function getAppellationTypeName(): string
    {
        return $this->appellationTypeName;
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
