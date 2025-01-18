<?php

namespace App\usecase\wine;

use App\domain\Producer;
use App\domain\Wine;
use App\gateways\repository\WineRepositoryInterface;

class GetWinesUseCase implements GetWinesUseCaseInterface
{
    public function __construct(private readonly WineRepositoryInterface $wineRepository)
    {
    }

    /**
     * @return array<array{producer: Producer, wine: Wine}>
     */
    public function handle(): array
    {
        return $this->wineRepository->getAll();
    }
}
