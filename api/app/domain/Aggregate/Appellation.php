<?php

namespace App\domain\Aggregate;

class Appellation
{
    public function __construct(
        private readonly ?int $id,
        private readonly string $name,
        private readonly string $regulation,
        private readonly AppellationType $appellationType,
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

    public function getRegulation(): string
    {
        return $this->regulation;
    }

    public function getAppellationType(): AppellationType
    {
        return $this->appellationType;
    }
}
