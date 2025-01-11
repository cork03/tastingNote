<?php

namespace App\usecase\wine\types;

use App\domain\WineType;
use App\gateways\repository\wine\wineTypes\WineTypesRepositoryInterface;

class GetWineTypesUseCase implements GetWineTypesUseCaseInterface
{
    public function __construct(private readonly WineTypesRepositoryInterface $wineTypesRepository)
    {
    }

    /**
     * @return WineType[]
     */
    public function handle(): array
    {
        return $this->wineTypesRepository->getAll();
    }
}
