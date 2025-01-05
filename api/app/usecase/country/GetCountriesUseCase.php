<?php

namespace App\usecase\country;

use App\domain\Country;
use App\gateways\repository\CountryRepositoryInterface;

class GetCountriesUseCase implements GetCountriesUseCaseInterface
{
    public function __construct(private readonly CountryRepositoryInterface $countryRepository)
    {
    }

    /**
     * @return Country[]
     */
    public function handle(): array
    {
        return $this->countryRepository->getAll();
    }
}
