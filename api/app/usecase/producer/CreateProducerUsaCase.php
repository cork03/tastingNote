<?php

namespace App\usecase\producer;

use App\usecase\gateways\repository\ProducerRepositoryInterface;

class CreateProducerUsaCase implements CreateProducerUseCaseInterface
{
    public function __construct(private readonly ProducerRepositoryInterface $producerRepository)
    {
    }

    public function handle(CreateProducerUsaCaseInput $input): void
    {
        $this->producerRepository->create($input->getProducer());
    }
}
