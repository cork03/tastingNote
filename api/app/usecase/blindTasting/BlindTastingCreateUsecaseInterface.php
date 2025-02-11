<?php

namespace App\usecase\blindTasting;

interface BlindTastingCreateUsecaseInterface
{
    public function handle(BlindTastingCreateUsecaseInput $input): int;
}
