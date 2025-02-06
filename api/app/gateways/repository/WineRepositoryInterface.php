<?php

namespace App\gateways\repository;

use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineFullInfo;

interface WineRepositoryInterface
{
    public function create(Wine $wine): Wine;

    /**
     * @return array<array{producer: Producer, wine: Wine}>
     */
    public function getAll(): array;

    public function getWineWithVintagesById(int $wineId): WineFullInfo;
}
