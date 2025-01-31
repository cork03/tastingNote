<?php
namespace App\presenter\creator;

use App\domain\Country;
use App\domain\Producer;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\ProducerJson;

class ProducerJsonCreator
{
    public function create(Producer $producer): ProducerJson
    {
        return new ProducerJson(
            id: $producer->getId(),
            name: $producer->getName(),
            country: (new CountryJsonCreator())->create($producer->getCountry()),
            description: $producer->getDescription(),
            url: $producer->getUrl()
        );
    }
}
