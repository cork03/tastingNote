<?php

namespace App\usecase\producer;

use App\domain\Producer;
use App\gateways\repository\ProducerRepository;
use App\gateways\repository\ProducerRepositoryInterface;

class GetProducersUseCase implements GetProducersUseCaseInterface
{
    public function __construct(private readonly ProducerRepositoryInterface $producerRepository)
    {
    }

    /**
     * @return Producer[]
     */
    public function handle(): array
    {
        return $this->producerRepository->getAll();
    }
}
