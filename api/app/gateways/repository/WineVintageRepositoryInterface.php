<?php

namespace App\gateways\repository;

use App\domain\WineVintage;

interface WineVintageRepositoryInterface
{
    public function create(WineVintage $wineVintage): void;
}
