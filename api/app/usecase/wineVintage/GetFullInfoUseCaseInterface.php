<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintageFullInfo;

interface GetFullInfoUseCaseInterface
{
    /**
     * @return array{wineVintageFullInfo: WineVintageFullInfo, imagePath: string}
     */
    public function handle(int $id, int $vintage): array;
}
