<?php

namespace App\usecase\appellation;

interface AppellationCreateUseCaseInterface
{
    public function handle(AppellationCreateUseCaseInput $input): void;
}
