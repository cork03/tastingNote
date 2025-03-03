<?php

namespace App\interfaceAdapter\queryService;

interface UpdateWineUseCaseQueryServiceInterface
{
    public function getAppellationCountryId(int $appellationId): ?int;
}
