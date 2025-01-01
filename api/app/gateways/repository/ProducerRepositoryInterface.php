<?php

namespace App\gateways\repository;

use App\domain\Producer;
use App\domain\Wine;

interface ProducerRepositoryInterface
{
    public function create(Producer $producer): void;

    /**
     * @return Producer[]
     */
    public function getAll(): array;

    /**
     * @return Wine[]
     */
    public function getWines(int $producerId): array;
}
