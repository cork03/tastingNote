<?php

namespace App\gateways\queryService;

use App\interfaceAdapter\queryService\GetWinesUseCaseQueryServiceInterface;
use App\usecase\wine\GetWineUseCase\AppellationDTO;
use App\usecase\wine\GetWineUseCase\AppellationTypeDTO;
use App\usecase\wine\GetWineUseCase\ProducerDTO;
use App\usecase\wine\GetWineUseCase\wineDTO;
use App\Models\Wine as WineModel;
use Illuminate\Database\Eloquent\Collection;

class GetWinesUseCaseQueryService implements GetWinesUseCaseQueryServiceInterface
{
    public function __construct(private readonly WineModel $wineModel)
    {
    }

    /**
     * @return wineDTO[]
     */
    public function getWines(): array
    {
        $wineModels = $this->wineModel->with([
            'producer',
            'wineType',
            'country',
            'wineVintages:id,wine_id,image_path,vintage',
            'appellation.appellationType'
        ])->orderBy('country_id')->get();
        $wineDTOs = [];
        foreach ($wineModels as $wineModel) {
            /** @var Collection $winVintages */
            $winVintages = $wineModel->wineVintages->sortByDesc('vintage');
            $imagePath = null;
            foreach ($winVintages as $winVintage) {
                if (isset($winVintage->image_path)) {
                    $imagePath = $winVintage->image_path;
                    break;
                }
            }
            $appellation = $wineModel->appellation;
            if (isset($appellation)) {
                $appellation = new appellationDTO(
                    id: $appellation->id,
                    name: $appellation->name,
                    regulation: $appellation->regulation,
                    appellationType: new AppellationTypeDTO(
                        id: $appellation->appellationType->id,
                        name: $appellation->appellationType->name
                    )
                );
            }
            $wineDTOs[] = new wineDTO(
                id: $wineModel->id,
                name: $wineModel->name,
                wineTypeId: $wineModel->wine_type_id,
                wineTypeName: $wineModel->wineType->name,
                countryId: $wineModel->country_id,
                countryName: $wineModel->country->name,
                producer: new ProducerDTO(
                    id: $wineModel->producer->id,
                    name: $wineModel->producer->name,
                    description: $wineModel->producer->description,
                    url: $wineModel->producer->url
                ),
                appellation: $appellation,
                latestVintageImagePath: $imagePath
            );
        }
        return $wineDTOs;
    }
}
