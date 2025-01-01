<?php

namespace App\usecase\grapeVariety;

use App\domain\GrapeVariety;
use App\gateways\repository\GrapeVarietyRepositoryInterface;

class GetGrapeVarietiesUseCase implements GetGrapeVarietiesUseCaseInterface
{
    public function __construct(private readonly GrapeVarietyRepositoryInterface $grapeVarietyRepository)
    {
    }

    /**
     * @return GrapeVariety[]
     */
    public function handle(): array
    {
        return $this->grapeVarietyRepository->getAll();
    }
}
