<?php

namespace App\presenter;

use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineFullInfo;
use App\presenter\creator\ProducerJsonCreator;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\ProducerJson;
use App\presenter\jsonClass\WineFullInfoJson;
use App\presenter\jsonClass\WineTypeJson;
use App\presenter\jsonClass\WineVarietyJson;
use App\presenter\jsonClass\WineVintageJson;
use App\presenter\jsonClass\WineWithProducerJson;
use App\usecase\wine\GetWineUseCase\wineDTOWithImagePath;
use Illuminate\Http\JsonResponse;

class WinePresenter
{
    /**
     * @param wineDTOWithImagePath[] $wineDTOs
     */
    public function getWinesResponse(array $wineDTOs): JsonResponse
    {
        $winesWithProducerJson = [];
        foreach ($wineDTOs as $wineDTO) {
            $country = new CountryJson(
                id: $wineDTO->getCountryId(),
                name: $wineDTO->getCountryName(),
            );
            $winesWithProducerJson[] = new WineWithProducerJson(
                id: $wineDTO->getId(),
                name: $wineDTO->getName(),
                producer: new ProducerJson(
                    id: $wineDTO->getProducer()->getId(),
                    name: $wineDTO->getProducer()->getName(),
                    country: $country,
                    description: $wineDTO->getProducer()->getDescription(),
                    url: $wineDTO->getProducer()->getUrl(),
                ),
                wineType: new WineTypeJson(
                    id: $wineDTO->getWineTypeId(),
                    label: $wineDTO->getWineTypeName(),
                ),
                country: $country,
                imagePath: $wineDTO->getLatestVintageImagePath(),
            );
        }
        return response()->json($winesWithProducerJson);
    }

    public function getWineWithVintagesResponse(WineFullInfo $wineFullInfo): JsonResponse
    {
        $wineVintagesJson = [];
        foreach ($wineFullInfo->getWineVintages() as $wineVintage) {
            $wineVintagesJson[] = new WineVintageJson(
                id: $wineVintage->getId(),
                wineId: $wineVintage->getWineId(),
                vintage: $wineVintage->getVintage(),
                price: $wineVintage->getPrice(),
                agingMethod: $wineVintage->getAgingMethod(),
                alcoholContent: $wineVintage->getAlcoholContent(),
                wineBlend: array_map(
                    fn($wineVariety) => new WineVarietyJson(
                        name: $wineVariety->getGrapeVariety()->getName(),
                        percentage: $wineVariety->getPercentage(),
                        id: $wineVariety->getGrapeVariety()->getId(),
                    ),
                    $wineVintage->getWineBlend()->getWineVarieties()
                ),
                technicalComment: $wineVintage->getTechnicalComment()
            );
        }
        $wine = $wineFullInfo->getWine();
        $producer = $wineFullInfo->getProducer();
        $wineType = $wine->getWineType();
        $country = $wine->getCountry();
        $wineFullInfoJson = new WineFullInfoJson(
            id: $wine->getId(),
            name: $wine->getName(),
            producer: (new ProducerJsonCreator())->create($producer),
            wineType: new WineTypeJson(
                id: $wineType->value,
                label: $wineType->getLabel(),
            ),
            country: new CountryJson(
                id: $country->getId(),
                name: $country->getName(),
            ),
            wineVintages: $wineVintagesJson
        );
        return response()->json($wineFullInfoJson);
    }
}
