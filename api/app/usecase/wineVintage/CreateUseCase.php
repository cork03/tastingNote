<?php

namespace App\usecase\wineVintage;

use App\gateways\repository\WineVintageRepositoryInterface;
use App\usecase\wine\CreateWineVintageUseCaseInput;

class CreateUseCase implements CreateUseCaseInterface
{
    public function __construct(private readonly WineVintageRepositoryInterface $wineVintageRepository)
    {
    }

    public function handle(CreateWineVintageUseCaseInput $input): void
    {
        $this->wineVintageRepository->create($input->getWineVintage());
    }
}
