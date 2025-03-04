<?php

namespace App\usecase\appellation\GetAppellationTypesUseCase;

use App\interfaceAdapter\queryService\GetAppellationTypesQueryServiceInterface;

class GetAppellationTypesUseCase implements GetAppellationTypesUseCaseInterface
{
    public function __construct(
        private readonly GetAppellationTypesQueryServiceInterface $appellationTypesQueryService
    )
    {
    }

    /**
     * @return GetAppellationTypesUseCaseDTO[]
     */
    public function handle(): array
    {
        return $this->appellationTypesQueryService->handle();
    }
}
