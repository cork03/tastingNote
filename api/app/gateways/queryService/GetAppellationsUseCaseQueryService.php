<?php

namespace App\gateways\queryService;

use App\interfaceAdapter\queryService\GetAppellationsUseCaseQueryServiceInterface;
use App\Models\Appellation as AppellationModel;
use App\usecase\appellation\GetAppellationsUsecase\GetAppellationsUseCaseDTO;
use Illuminate\Database\Eloquent\Collection;

class GetAppellationsUseCaseQueryService implements GetAppellationsUseCaseQueryServiceInterface
{
    public function __construct(private readonly AppellationModel $appellationModel)
    {
    }

    /**
     * @return GetAppellationsUseCaseDTO[]
     */
    public function getAppellations(): array
    {
        /**
         * @var Collection $appellationsModel
         */
        $appellationsModel = $this->appellationModel->with('appellationType.country')->get();
        $appellationsDTO = [];
        foreach ($appellationsModel as $appellationModel) {
            $appellationsDTO[] = new GetAppellationsUseCaseDTO(
                $appellationModel->id,
                $appellationModel->name,
                $appellationModel->regulation,
                $appellationModel->appellationType->id,
                $appellationModel->appellationType->name,
                $appellationModel->appellationType->country->id,
                $appellationModel->appellationType->country->name,
            );
        }
        return $appellationsDTO;
    }
}
