<?php

namespace App\usecase\wine;

use App\domain\Producer;
use App\domain\Wine;

interface GetWinesUseCaseInterface
{
    /**
     * @return array<array{producer: Producer, wine: Wine}>
     */
    public function handle(): array;
}
