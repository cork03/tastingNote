<?php

namespace App\usecase\producer\GetProducerWinesUseCase;

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
