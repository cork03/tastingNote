<?php

namespace App\gateways\queryService;

use App\interfaceAdapter\queryService\GetProducerWinesUseCaseQueryServiceInterface;
use App\Models\Producer as ProducerModel;
use App\usecase\producer\GetProducerWinesUseCase\AppellationDTO;
use App\usecase\producer\GetProducerWinesUseCase\AppellationTypeDTO;
use App\usecase\producer\GetProducerWinesUseCase\CountryDTO;
use App\usecase\producer\GetProducerWinesUseCase\ProducerWineDTO;
use App\usecase\producer\GetProducerWinesUseCase\WineTypeDTO;
use Illuminate\Database\Eloquent\Collection;

class GetProducerWinesUseCaseQueryService implements GetProducerWinesUseCaseQueryServiceInterface
{
    public function __construct(private readonly ProducerModel $producerModel)
    {
    }

    /**
     * @return ProducerWineDTO[]
     */
    public function getWines(int $producerId): array
    {
        $producer = $this->producerModel->with([
            'wines.country',
            'wines.appellation.appellationType',
            'wines.wineVintages'
        ])->find($producerId);
        if (!isset($producer)) {
            return [];
        }
        $producerWines = [];
        foreach ($producer->wines as $wineModel) {
            $appellation = $wineModel->appellation;
            if(isset($appellation)) {
                $appellation = new AppellationDTO(
                    id: $appellation->id,
                    name: $appellation->name,
                    regulation: $appellation->regulation,
                    appellationType: new AppellationTypeDTO(
                        id: $appellation->appellationType->id,
                        name: $appellation->appellationType->name
                    )
                );
            }
            /** @var Collection $winVintages */
            $winVintages = $wineModel->wineVintages->sortByDesc('vintage');
            $imagePath = null;
            foreach ($winVintages as $winVintage) {
                if (isset($winVintage->image_path)) {
                    $imagePath = $winVintage->image_path;
                    break;
                }
            }
            $producerWines[] = new ProducerWineDTO(
                id: $wineModel->id,
                name: $wineModel->name,
                producerId: $producer->id,
                wineType: new WineTypeDTO(
                    id: $wineModel->wineType->id,
                    name: $wineModel->wineType->name
                ),
                country: new CountryDTO(
                    id: $wineModel->country->id,
                    name: $wineModel->country->name
                ),
                appellation: $appellation,
                latestVintageImagePath: $imagePath
            );
        }
        return $producerWines;
    }
}
