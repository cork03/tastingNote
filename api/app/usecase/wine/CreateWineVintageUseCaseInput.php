<?php

namespace App\usecase\wine;

use App\domain\WineVintage;

class CreateWineVintageUseCaseInput
{
    public function __construct(private readonly WineVintage $wineVintage)
    {
    }

    public function getWineVintage(): WineVintage
    {
        return $this->wineVintage;
    }
}
