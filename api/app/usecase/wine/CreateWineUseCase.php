<?php

namespace App\usecase\wine;

use App\domain\Wine;
use App\gateways\repository\WineRepositoryInterface;

class CreateWineUseCase implements CreateWineUseCaseInterface
{
    public function __construct(private readonly WineRepositoryInterface $wineRepository)
    {
    }

    public function handle(CreateWineUseCaseInput $input): Wine
    {
        return $this->wineRepository->create($input->getWine());
    }
}
