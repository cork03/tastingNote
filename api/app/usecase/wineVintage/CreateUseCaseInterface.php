<?php

namespace App\usecase\wineVintage;

interface CreateUseCaseInterface
{
    public function handle(CreateWineVintageUseCaseInput $input): void;
}
