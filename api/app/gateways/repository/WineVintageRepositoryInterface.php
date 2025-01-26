<?php

namespace App\gateways\repository;

use App\domain\WineVintage;
use App\domain\WineVintageFullInfo;

interface WineVintageRepositoryInterface
{
    public function create(WineVintage $wineVintage): void;
    public function getWithWineByWineIdAndVintage(int $wineId, int $vintage): WineVintageFullInfo;
}
