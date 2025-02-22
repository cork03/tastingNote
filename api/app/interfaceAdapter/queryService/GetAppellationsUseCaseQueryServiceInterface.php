<?php

namespace App\interfaceAdapter\queryService;

use App\usecase\appellation\GetAppellationsUseCaseDTO;

interface GetAppellationsUseCaseQueryServiceInterface
{
    /**
     * @return GetAppellationsUseCaseDTO[];
     */
    public function getAppellations(): array;
}
