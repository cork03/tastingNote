<?php

namespace App\gateways\repository;

use App\domain\Aggregate\Wine;
use App\domain\WineFullInfo;

interface WineRepositoryInterface
{
    public function create(Wine $wine): Wine;

    public function getWineWithVintagesById(int $wineId): WineFullInfo;
}
