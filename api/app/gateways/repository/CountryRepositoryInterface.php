<?php

namespace App\gateways\repository;

use App\domain\Country;

interface CountryRepositoryInterface
{
    /**
     * @return Country[]
     */
    public function getAll(): array;
}
