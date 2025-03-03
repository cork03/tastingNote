<?php

namespace App\gateways\queryService;

use App\interfaceAdapter\queryService\UpdateWineUseCaseQueryServiceInterface;
use App\Models\Appellation as AppellationModel;

class UpdateWineUseCaseQueryService implements UpdateWineUseCaseQueryServiceInterface
{
    public function __construct(
        private readonly AppellationModel $appellationModel,
    )
    {
    }

    public function getAppellationCountryId(int $appellationId): ?int
    {
        $appellation = $this->appellationModel->with('appellationType.country:id')->find($appellationId);
        if ($appellation === null) {
            return null;
        }
        return $appellation->appellationType->country->id;
    }
}
