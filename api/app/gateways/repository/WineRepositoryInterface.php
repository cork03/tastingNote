<?php

namespace App\gateways\repository;

use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineFullInfo;

interface WineRepositoryInterface
{
    public function create(Wine $wine): void;

    /**
     * @return array<array{producer: Producer, wine: Wine}>
     */
    public function getAll(): array;

    public function getWineWithVintageById(int $wineId): WineFullInfo;
}
