<?php

namespace App\usecase\wine;

use App\gateways\repository\WineVintageRepositoryInterface;

class CreateWineVintageUseCase implements CreateWineVintageUseCaseInterface
{
    public function __construct(private readonly WineVintageRepositoryInterface $wineVintageRepository)
    {
    }

    public function handle(CreateWineVintageUseCaseInput $input): void
    {
        $this->wineVintageRepository->create($input->getWineVintage());
    }
}
