<?php

namespace App\gateways\queryService;

use App\interfaceAdapter\queryService\GetWineWithVintagesUseCaseQueryServiceInterface;
use App\usecase\commonDTO\AppellationDTO;
use App\usecase\commonDTO\AppellationTypeDTO;
use App\usecase\commonDTO\CountryDTO;
use App\usecase\commonDTO\GrapeVarietyDTO;
use App\usecase\commonDTO\WineTypeDTO;
use App\usecase\commonDTO\WineVarietyDTO;
use App\usecase\wine\GetWineWithVintagesUseCase\ProducerDTO;
use App\usecase\wine\GetWineWithVintagesUseCase\WineDTO;
use App\usecase\wine\GetWineWithVintagesUseCase\WineInfoDTO;
use App\Models\Wine as WineModel;
use App\usecase\wine\GetWineWithVintagesUseCase\WineVintageDTO;

class GetWineWithVintagesUseCaseQueryService implements GetWineWithVintagesUseCaseQueryServiceInterface
{
    public function __construct(
        private readonly WineModel $wineModel,
    )
    {
    }

    public function getWineWithVintagesById(int $wineId): WineInfoDTO
    {
        $wineModel = $this->wineModel->with(
            [
                'wineVintages.grapeVarieties',
                'country',
                'producer',
                'appellation.appellationType'
            ]
        )->find($wineId);
        $wineVintages = [];
        foreach ($wineModel->wineVintages as $wineVintageModel) {
            $wineVariety = [];
            foreach ($wineVintageModel->grapeVarieties as $grapeVariety) {
                $wineVariety[] = new WineVarietyDTO(
                    grapeVariety: new GrapeVarietyDTO(
                        id: $grapeVariety->id,
                        name: $grapeVariety->name
                    ),
                    percentage: $grapeVariety->pivot->percentage
                );
            }
            $wineVintages[] = new WineVintageDTO(
                id: $wineVintageModel->id,
                wineId: $wineVintageModel->wine_id,
                vintage: $wineVintageModel->vintage,
                price: $wineVintageModel->price,
                agingMethod: $wineVintageModel->aging_method,
                alcoholContent: $wineVintageModel->alcohol_content,
                wineBlend: $wineVariety,
                technicalComment: $wineVintageModel->technical_comment,
                imagePath: $wineVintageModel->image_path
            );
        }
        $country = new CountryDTO(
            id: $wineModel->country->id,
            name: $wineModel->country->name
        );
        $appellation = null;
        if (isset($wineModel->appellation)) {
            $appellation = new AppellationDTO(
                id: $wineModel->appellation->id,
                name: $wineModel->appellation->name,
                regulation: $wineModel->appellation->regulation,
                appellationType: new AppellationTypeDTO(
                    id: $wineModel->appellation->appellationType->id,
                    name: $wineModel->appellation->appellationType->name
                )
            );
        }
        return new WineInfoDTO(
            producer: new ProducerDTO(
                id: $wineModel->producer->id,
                name: $wineModel->producer->name,
                description: $wineModel->producer->description,
                url: $wineModel->producer->url
            ),
            wine: new WineDTO(
                id: $wineModel->id,
                name: $wineModel->name,
                producerId: $wineModel->producer_id,
                wineType: new WineTypeDTO(
                    id: $wineModel->wine_type_id,
                    name: $wineModel->wineType->name
                ),
                country: $country,
                vineVintages: $wineVintages,
                appellation: $appellation
            )
        );
    }
}
