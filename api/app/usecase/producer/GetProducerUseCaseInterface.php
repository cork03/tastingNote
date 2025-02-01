<?php

namespace App\usecase\producer;

use App\domain\Producer;

interface GetProducerUseCaseInterface
{
    public function handle(int $producerId): ?Producer;
}
