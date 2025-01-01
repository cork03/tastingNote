<?php

namespace App\gateways\repository;

use App\domain\GrapeVariety;

interface GrapeVarietyRepositoryInterface
{
    /**
     * @return GrapeVariety[]
     */
    public function getAll(): array;
}
