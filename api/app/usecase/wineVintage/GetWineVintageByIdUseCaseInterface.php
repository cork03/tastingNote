<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintage;

interface GetWineVintageByIdUseCaseInterface
{

    /**
     * @return ?array{wineVintage: WineVintage, imagePath: ?string}
     */
    public function handle(int $id): ?array;
}
