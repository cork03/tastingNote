<?php

namespace App\gateways\queryService;

use App\interfaceAdapter\queryService\GetAppellationTypesQueryServiceInterface;
use App\Models\AppellationType as AppellationTypeModel;
use App\usecase\appellation\GetAppellationTypesUseCaseDTO;
use Illuminate\Database\Eloquent\Collection;

class GetAppellationTypesQueryService implements GetAppellationTypesQueryServiceInterface
{
    public function __construct(
        private readonly AppellationTypeModel $appellationTypeModel,
    )
    {
    }

    public function handle(): array
    {
        /**
         * @var Collection $appellationTypesModel
         */
        $appellationTypesModel = $this->appellationTypeModel->with('country')->get();
        $appellationTypes = [];
        foreach ($appellationTypesModel as $appellationTypeModel) {
            $appellationTypes[] = new GetAppellationTypesUseCaseDTO(
                id: $appellationTypeModel->id,
                name: $appellationTypeModel->name,
                countryId: $appellationTypeModel->country->id,
                countryName: $appellationTypeModel->country->name
            );
        }
        return $appellationTypes;
    }
}
