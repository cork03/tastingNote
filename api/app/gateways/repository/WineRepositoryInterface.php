<?php

namespace App\gateways\repository;

use App\domain\Wine;

interface WineRepositoryInterface
{
    public function create(Wine $wine): void;
}
