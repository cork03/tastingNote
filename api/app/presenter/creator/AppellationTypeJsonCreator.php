<?php
namespace App\presenter\creator;

use App\domain\AppellationType;
use App\presenter\jsonClass\AppellationTypeJson;

class AppellationTypeJsonCreator
{
    public function create(AppellationType $appellationType): AppellationTypeJson
    {
        return new AppellationTypeJson(
            id: $appellationType->getId(),
            name: $appellationType->getName(),
            country: (new CountryJsonCreator())->create($appellationType->getCountry())
        );
    }
}
