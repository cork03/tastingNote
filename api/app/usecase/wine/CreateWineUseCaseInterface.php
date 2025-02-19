<?php

namespace App\usecase\wine;


use App\domain\Aggregate\Wine;

interface CreateWineUseCaseInterface
{
    public function handle(CreateWineUseCaseInput $input): Wine;
}
