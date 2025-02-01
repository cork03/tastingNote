<?php

namespace App\usecase\producer;

use App\domain\Producer;
use App\gateways\repository\ProducerRepositoryInterface;

class GetProducerUseCase implements GetProducerUseCaseInterface
{
    public function __construct(private readonly ProducerRepositoryInterface $producerRepository)
    {
    }

    public function handle(int $producerId): ?Producer
    {
        return $this->producerRepository->getOneById($producerId);
    }
}
