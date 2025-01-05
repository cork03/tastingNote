<?php

namespace App\usecase\wine;

interface CreateWineVintageUseCaseInterface
{
    public function handle(CreateWineVintageUseCaseInput $input): void;
}
