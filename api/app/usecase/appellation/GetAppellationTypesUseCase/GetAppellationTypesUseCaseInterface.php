<?php

namespace App\usecase\appellation\GetAppellationTypesUseCase;

interface GetAppellationTypesUseCaseInterface
{
    /**
     * @return GetAppellationTypesUseCaseDTO[]
     */
    public function handle(): array;
}
