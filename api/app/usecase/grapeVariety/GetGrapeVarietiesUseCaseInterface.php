<?php

namespace App\usecase\grapeVariety;

use App\domain\GrapeVariety;

interface GetGrapeVarietiesUseCaseInterface
{
    /**
     * @return GrapeVariety[]
     */
    public function handle(): array;
}
