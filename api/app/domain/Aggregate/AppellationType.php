<?php

namespace App\domain\Aggregate;

use App\domain\Country;

class AppellationType
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $name,
        private readonly int $countryId,
    )
    {
    }

    public function getId(): ?int
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
}
