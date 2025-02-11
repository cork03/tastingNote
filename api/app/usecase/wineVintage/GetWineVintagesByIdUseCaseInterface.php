<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintage;

interface GetWineVintagesByIdUseCaseInterface
{
    /**
     * @return array<array{wineVintage: WineVintage, imagePath: ?string}>
     */
    public function handle(int $id): array;
}
