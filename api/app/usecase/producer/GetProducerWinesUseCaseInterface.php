<?php

namespace App\usecase\producer;

use App\domain\Wine;

interface GetProducerWinesUseCaseInterface
{
    /**
     * @return Wine[]
     */
    public function handle(GetProducerWinesUseCaseInput $input): array;
}
