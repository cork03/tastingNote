<?php

namespace App\usecase\wine;

use App\domain\WineFullInfo;
use App\gateways\repository\WineRepositoryInterface;

class GetWineWithVintagesUseCase implements GetWineWithVintagesUseCaseInterface
{
    public function __construct(private readonly WineRepositoryInterface $wineRepository)
    {
    }

    public function handle(int $wineId): WineFullInfo
    {
        return $this->wineRepository->getWineWithVintageById($wineId);
    }
}
