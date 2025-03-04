<?php

namespace App\usecase\appellation\AppellationCreateUseCase;

interface AppellationCreateUseCaseInterface
{
    public function handle(AppellationCreateUseCaseInput $input): void;
}
