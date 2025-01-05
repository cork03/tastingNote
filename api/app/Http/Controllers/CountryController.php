<?php

namespace App\Http\Controllers;

use App\presenter\CountryPresenter;
use App\usecase\country\GetCountriesUseCaseInterface;
use Illuminate\Http\JsonResponse;

class CountryController
{
    public function __construct(
        private readonly GetCountriesUseCaseInterface $getCountriesUseCase,
        private readonly CountryPresenter $countryPresenter
    )
    {
    }

    public function getAll(): JsonResponse
    {
        $countries = $this->getCountriesUseCase->handle();
        return $this->countryPresenter->getCountries($countries);
    }
}
