<?php

namespace App\gateways\repository;

use App\domain\Aggregate\Wine;

interface WineRepositoryInterface
{
    public function create(Wine $wine): Wine;
}
