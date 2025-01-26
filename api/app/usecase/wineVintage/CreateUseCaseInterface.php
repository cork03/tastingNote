<?php

namespace App\usecase\wineVintage;

use App\usecase\wine\CreateWineVintageUseCaseInput;

interface CreateUseCaseInterface
{
    public function handle(CreateWineVintageUseCaseInput $input): void;
}
