<?php

namespace App\gateways\repository;

use App\domain\Producer;
use App\domain\Wine;

interface WineRepositoryInterface
{
    public function create(Wine $wine): void;

    /**
     * @return array<array{producer: Producer, wine: Wine}>
     */
    public function getAll(): array;
}
