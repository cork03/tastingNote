<?php

namespace App\interfaceAdapter\queryService;

use App\usecase\appellation\GetAppellationTypesUseCaseDTO;

interface GetAppellationTypesQueryServiceInterface
{
    /**
     * @return GetAppellationTypesUseCaseDTO[]
     */
    public function handle(): array;
}
