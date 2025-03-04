<?php

namespace App\usecase\appellation\GetAppellationsUsecase;

use App\interfaceAdapter\queryService\GetAppellationsUseCaseQueryServiceInterface;

class GetAppellationsUseCase implements GetAppellationsUseCaseInterface
{
    public function __construct(
        private readonly GetAppellationsUseCaseQueryServiceInterface $queryService
    )
    {
    }

    /**
     * @return GetAppellationsUseCaseDTO[]
     */
    public function handle(): array
    {
        return $this->queryService->getAppellations();
    }
}
