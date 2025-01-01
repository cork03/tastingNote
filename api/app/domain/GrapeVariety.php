<?php

namespace App\domain;

class GrapeVariety
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $name
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
}
