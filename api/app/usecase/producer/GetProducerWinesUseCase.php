<?php

namespace App\usecase\producer;

use App\domain\Producer;
use App\domain\Wine;
use App\gateways\repository\ProducerRepository;
use App\gateways\repository\ProducerRepositoryInterface;

class GetProducerWinesUseCase implements GetProducerWinesUseCaseInterface
{
    public function __construct(private readonly ProducerRepositoryInterface $producerRepository)
    {
    }

    /**
     * @return Wine[]
     */
    public function handle(GetProducerWinesUseCaseInput $input): array
    {
        return $this->producerRepository->getWines($input->getProducerId());
    }
}
