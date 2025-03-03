<?php

namespace App\usecase\wine\UpdateWineUseCase;

interface UpdateWineUseCaseInterface
{
    public function handle(UpdateWineUseCaseInput $input): void;
}
