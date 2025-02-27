<?php

namespace App\gateways\queryService;

use App\interfaceAdapter\queryService\GetWinesUseCaseQueryServiceInterface;
use App\usecase\wine\GetWineUseCase\producerDTO;
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
        $wineModels = $this->wineModel->with(['producer', 'wineType', 'country', 'wineVintages:id,wine_id,image_path,vintage'])->orderBy('country_id')->get();
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
            $wineDTOs[] = new wineDTO(
                id: $wineModel->id,
                name: $wineModel->name,
                wineTypeId: $wineModel->wine_type_id,
                wineTypeName: $wineModel->wineType->name,
                countryId: $wineModel->country_id,
                countryName: $wineModel->country->name,
                producer: new producerDTO(
                    id: $wineModel->producer->id,
                    name: $wineModel->producer->name,
                    description: $wineModel->producer->description,
                    url: $wineModel->producer->url
                ),
                latestVintageImagePath: $imagePath
            );
        }
        return $wineDTOs;
    }
}
