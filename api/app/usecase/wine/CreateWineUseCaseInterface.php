<?php

namespace App\usecase\wine;

use App\domain\Wine;

interface CreateWineUseCaseInterface
{
    public function handle(CreateWineUseCaseInput $input): Wine;
}
