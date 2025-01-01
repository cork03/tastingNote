<?php

namespace App\usecase\producer;

class GetProducerWinesUseCaseInput
{
    public function __construct(private readonly int $producerId)
    {
    }

    public function getProducerId(): int
    {
        return $this->producerId;
    }

}
