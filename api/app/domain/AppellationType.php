<?php

namespace App\domain;

class AppellationType
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $name,
        private readonly Country $country,
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

    public function getCountry(): Country
    {
        return $this->country;
    }
}
