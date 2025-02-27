<?php

namespace App\usecase\wine\GetWineUseCase;

interface GetWinesUseCaseInterface
{
    /**
     * @return wineDTOWithImagePath[]
     */
    public function handle(): array;
}
