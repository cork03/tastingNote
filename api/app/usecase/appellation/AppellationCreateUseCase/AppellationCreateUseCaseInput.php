<?php

namespace App\usecase\appellation\AppellationCreateUseCase;

class AppellationCreateUseCaseInput
{
    public function __construct(
        private readonly string $name,
        private readonly string $regulation,
        private readonly ?int $appellationTypeId,
        private readonly string $appellationTypeName,
        private readonly int $countryId,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRegulation(): string
    {
        return $this->regulation;
    }

    public function getAppellationTypeId(): ?int
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
}
