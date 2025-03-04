<?php

namespace App\usecase\blindTasting\BlindTastingCreateUseCase;

interface BlindTastingCreateUseCaseInterface
{
    public function handle(BlindTastingCreateUseCaseInput $input): int;
}
