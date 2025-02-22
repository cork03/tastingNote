<?php

namespace App\interfaceAdapter\queryService;

interface CreateWineUseCaseQueryServiceInterface
{
    public function getAppellationCountryId(int $appellationId): ?int;
}
