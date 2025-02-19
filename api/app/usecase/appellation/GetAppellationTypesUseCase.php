<?php

namespace App\usecase\appellation;

use App\domain\AppellationType;
use App\gateways\repository\AppellationRepositoryInterface;

class GetAppellationTypesUseCase implements GetAppellationTypesUseCaseInterface
{
    public function __construct(
        private readonly AppellationRepositoryInterface $appellationRepository
    )
    {
    }

    /**
     * @return AppellationType[]
     */
    public function handle(): array
    {
        return $this->appellationRepository->getAppellationTypes();
    }
}
