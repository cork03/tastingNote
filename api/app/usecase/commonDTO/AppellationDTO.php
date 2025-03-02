<?php

namespace App\usecase\commonDTO;

class AppellationDTO
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $regulation,
        private readonly AppellationTypeDTO $appellationType,
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

    public function getAppellationType(): AppellationTypeDTO
    {
        return $this->appellationType;
    }
}
