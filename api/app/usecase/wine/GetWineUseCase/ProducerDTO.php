<?php

namespace App\usecase\wine\GetWineUseCase;

class ProducerDTO
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $description,
        private readonly ?string $url
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
