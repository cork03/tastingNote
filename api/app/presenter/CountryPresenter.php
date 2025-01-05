<?php

namespace App\presenter;

use App\domain\Country;
use App\presenter\jsonClass\CountryJson;
use Illuminate\Http\JsonResponse;

class CountryPresenter
{
    /**
     * @param Country[] $countries
     */
    public function getCountries(array $countries): JsonResponse
    {
        $countriesJson = [];
        foreach ($countries as $country) {
            $countriesJson[] = new CountryJson(
                id: $country->getId(),
                name: $country->getName()
            );
        }
        return response()->json($countriesJson);
    }
}
