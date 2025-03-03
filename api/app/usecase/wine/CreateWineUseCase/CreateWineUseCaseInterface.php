<?php

namespace App\usecase\wine\CreateWineUseCase;


use App\domain\Aggregate\Wine;

interface CreateWineUseCaseInterface
{
    public function handle(CreateWineUseCaseInput $input): Wine;
}
