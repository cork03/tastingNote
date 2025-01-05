<?php

namespace App\gateways\repository;

use App\domain\Country;
use App\models\Country as CountryModel;

class CountryRepository implements CountryRepositoryInterface
{
    public function __construct(private readonly CountryModel $countryModel)
    {
    }

    public function getAll(): array
    {
        $countriesEntities = $this->countryModel->get();
        $countries = [];
        foreach ($countriesEntities as $countriesEntity) {
            $countries[] = new Country(
                $countriesEntity->id,
                $countriesEntity->name,
            );
        }
        return $countries;
    }
}
