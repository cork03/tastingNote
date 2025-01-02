<?php

namespace App\usecase\wine;

use App\gateways\repository\WineRepositoryInterface;

class CreateWineUseCase implements CreateWineUseCaseInterface
{
    public function __construct(private readonly WineRepositoryInterface $wineRepository)
    {
    }

    public function handle(CreateWineUseCaseInput $input): void
    {
        $this->wineRepository->create($input->getWine());
    }
}
