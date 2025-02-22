<?php

namespace App\usecase\appellation;

interface GetAppellationTypesUseCaseInterface
{
    /**
     * @return GetAppellationTypesUseCaseDTO[]
     */
    public function handle(): array;
}
