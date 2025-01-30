<?php
namespace App\presenter\creator;

use App\domain\Country;
use App\presenter\jsonClass\CountryJson;

class CountryJsonCreator
{
    public function create(Country $country): CountryJson
    {
        return new CountryJson(
            id: $country->getId(),
            name: $country->getName(),
        );
    }
}
