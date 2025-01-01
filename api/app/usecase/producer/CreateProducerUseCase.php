<?php

namespace App\usecase\producer;

use App\gateways\repository\ProducerRepositoryInterface;

class CreateProducerUseCase implements CreateProducerUseCaseInterface
{
    public function __construct(private readonly ProducerRepositoryInterface $producerRepository)
    {
    }

    public function handle(CreateProducerUseCaseInput $input): void
    {
        $this->producerRepository->create($input->getProducer());
    }
}
