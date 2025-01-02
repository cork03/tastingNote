<?php

namespace App\usecase\wine;

use App\domain\Wine;

class CreateWineUseCaseInput
{
    public function __construct(private readonly Wine $wine)
    {
    }

    public function getWine(): Wine
    {
        return $this->wine;
    }
}
