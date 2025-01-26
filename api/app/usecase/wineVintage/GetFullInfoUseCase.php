<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintageFullInfo;
use App\gateways\repository\WineVintageRepositoryInterface;

class GetFullInfoUseCase implements GetFullInfoUseCaseInterface
{
    public function __construct(private readonly WineVintageRepositoryInterface $wineVintageRepository)
    {
    }

    public function handle(int $id, int $vintage): WineVintageFullInfo
    {
        return $this->wineVintageRepository->getWithWineByWineIdAndVintage($id, $vintage);
    }
}
