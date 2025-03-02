<?php

namespace App\usecase\producer\GetProducerWinesUseCase;

interface GetProducerWinesUseCaseInterface
{
    /**
     * @return ProducerWineWithImagePathDTO[]
     */
    public function handle(GetProducerWinesUseCaseInput $input): array;
}
