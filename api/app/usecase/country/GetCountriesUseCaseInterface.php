<?php

namespace App\usecase\country;

use App\domain\Country;

interface GetCountriesUseCaseInterface
{
    /**
     * @return Country[]
     */
    public function handle(): array;
}
