<?php

namespace App\usecase\producer;

use App\domain\Producer;

interface GetProducersUseCaseInterface
{
    /**
     * @return Producer[]
     */
    public function handle(): array;
}
