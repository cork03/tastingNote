<?php

namespace App\usecase\producer;

use App\domain\Producer;

class CreateProducerUseCaseInput
{
    public function __construct(private readonly Producer $producer)
    {
    }

    public function getProducer(): Producer
    {
        return $this->producer;
    }

}
