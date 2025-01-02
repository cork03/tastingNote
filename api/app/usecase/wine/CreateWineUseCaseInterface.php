<?php

namespace App\usecase\wine;

interface CreateWineUseCaseInterface
{
    public function handle(CreateWineUseCaseInput $input): void;
}
