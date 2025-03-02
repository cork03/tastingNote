<?php

namespace App\presenter;

use App\presenter\jsonClass\AppellationJson;
use App\presenter\jsonClass\AppellationTypeJson;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\ProducerJson;
use App\presenter\jsonClass\WineDetailJson;
use App\presenter\jsonClass\OldWineTypeJson;
use App\presenter\jsonClass\WineTypeJson;
use App\presenter\jsonClass\WineVarietyJson;
use App\presenter\jsonClass\WineVintageJson;
use App\presenter\jsonClass\WineJson;
use App\presenter\jsonClass\WineWithVintagesJson;
use App\usecase\wine\GetWineUseCase\wineDTOWithImagePath;
use App\usecase\wine\GetWineWithVintagesUseCase\WineInfoDTO;
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
            $appellation = $wineDTO->getAppellation();
            if ($appellation !== null) {
                $appellation = new AppellationJson(
                    id: $appellation->getId(),
                    name: $appellation->getName(),
                    regulation: $appellation->getRegulation(),
                    appellationType: new AppellationTypeJson(
                        id: $appellation->getAppellationType()->getId(),
                        name: $appellation->getAppellationType()->getName(),
                        country: $country,
                    ),
                );
            }
            $winesWithProducerJson[] = new WineJson(
                id: $wineDTO->getId(),
                name: $wineDTO->getName(),
                producer: new ProducerJson(
                    id: $wineDTO->getProducer()->getId(),
                    name: $wineDTO->getProducer()->getName(),
                    country: $country,
                    description: $wineDTO->getProducer()->getDescription(),
                    url: $wineDTO->getProducer()->getUrl(),
                ),
                wineType: new OldWineTypeJson(
                    id: $wineDTO->getWineTypeId(),
                    label: $wineDTO->getWineTypeName(),
                ),
                country: $country,
                appellation: $appellation,
                imagePath: $wineDTO->getLatestVintageImagePath(),
            );
        }
        return response()->json($winesWithProducerJson);
    }

    public function getWineWithVintagesResponse(WineInfoDTO $wineInfo): JsonResponse
    {
        $wineVintagesJson = [];
        $wine = $wineInfo->getWine();
        foreach ($wine->getVineVintages() as $vineVintage) {
            $wineVintagesJson[] = new WineVintageJson(
                id: $vineVintage->getId(),
                wineId: $vineVintage->getWineId(),
                vintage: $vineVintage->getVintage(),
                price: $vineVintage->getPrice(),
                agingMethod: $vineVintage->getAgingMethod(),
                alcoholContent: $vineVintage->getAlcoholContent(),
                wineBlend: array_map(
                    fn($wineVariety) => new WineVarietyJson(
                        name: $wineVariety->getGrapeVariety()->getName(),
                        percentage: $wineVariety->getPercentage(),
                        id: $wineVariety->getGrapeVariety()->getId(),
                    ),
                    $vineVintage->getWineBlend()
                ),
                technicalComment: $vineVintage->getTechnicalComment(),
                imagePath: $vineVintage->getImagePath(),
            );
        }
        $country = new CountryJson(
            id: $wineInfo->getWine()->getCountry()->getId(),
            name: $wineInfo->getWine()->getCountry()->getName(),
        );
        $producer = $wineInfo->getProducer();
        $appellation = null;
        if ($wine->getAppellation() !== null) {
            $appellation = new AppellationJson(
                id: $wine->getAppellation()->getId(),
                name: $wine->getAppellation()->getName(),
                regulation: $wine->getAppellation()->getRegulation(),
                appellationType: new AppellationTypeJson(
                    id: $wine->getAppellation()->getAppellationType()->getId(),
                    name: $wine->getAppellation()->getAppellationType()->getName(),
                    country: $country,
                ),
            );
        }
        $wineDetailJson = new WineDetailJson(
            producer: new ProducerJson(
                id: $producer->getId(),
                name: $producer->getName(),
                country: $country,
                description: $producer->getDescription(),
                url: $producer->getUrl(),
            ),
            wine: new WineWithVintagesJson(
                id: $wine->getId(),
                name: $wine->getName(),
                producerId: $wine->getProducerId(),
                wineType: new WineTypeJson(
                    id: $wine->getWineType()->getId(),
                    name: $wine->getWineType()->getName(),
                ),
                country: $country,
                wineVintages: $wineVintagesJson,
                appellation: $appellation
            )
        );
        return response()->json($wineDetailJson);
    }
}
