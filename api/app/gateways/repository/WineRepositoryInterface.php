<?php

namespace App\gateways\repository;

use App\domain\Aggregate\Wine;
use App\domain\Wine as WineDomain;
use App\domain\Producer;
use App\domain\WineFullInfo;

interface WineRepositoryInterface
{
    public function create(Wine $wine): Wine;

    /**
     * @return array<array{producer: Producer, wine: WineDomain}>
     */
    public function getAll(): array;

    public function getWineWithVintagesById(int $wineId): WineFullInfo;
}
