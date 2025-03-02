<?php

namespace App\interfaceAdapter\queryService;

use App\usecase\producer\GetProducerWinesUseCase\ProducerWineDTO;

interface GetProducerWinesUseCaseQueryServiceInterface
{
    /**
     * @return ProducerWineDTO[]
     */
    public function getWines(int $producerId): array;
}
