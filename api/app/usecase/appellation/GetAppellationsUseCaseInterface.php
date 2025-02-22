<?php

namespace App\usecase\appellation;

interface GetAppellationsUseCaseInterface
{
    /**
     * @return GetAppellationsUseCaseDTO[]
     */
    public function handle(): array;
}
