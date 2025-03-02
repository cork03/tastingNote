<?php

namespace App\usecase\wine\GetWineWithVintagesUseCase;

class WineInfoDTO
{
    public function __construct(
        private readonly ProducerDTO $producer,
        private readonly WineDTO     $wine,
    )
    {
    }

    public function getProducer(): ProducerDTO
    {
        return $this->producer;
    }

    public function getWine(): WineDTO
    {
        return $this->wine;
    }
}
