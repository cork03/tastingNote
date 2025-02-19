<?php

namespace App\usecase\appellation;

use App\domain\AppellationType;

interface GetAppellationTypesUseCaseInterface
{
    /**
     * @return AppellationType[]
     */
    public function handle(): array;
}
