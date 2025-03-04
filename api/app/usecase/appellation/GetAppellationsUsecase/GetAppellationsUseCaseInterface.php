<?php

namespace App\usecase\appellation\GetAppellationsUsecase;

interface GetAppellationsUseCaseInterface
{
    /**
     * @return GetAppellationsUseCaseDTO[]
     */
    public function handle(): array;
}
