<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintage;

interface EditWineVintageUseCaseInterface
{
    public function handle(WineVintage $wineVintage, ?string $base64Image): void;
}
