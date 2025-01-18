<?php

namespace App\usecase\wine;

use App\domain\WineFullInfo;

interface GetWineWithVintagesUseCaseInterface
{
    public function handle(int $wineId): WineFullInfo;
}
