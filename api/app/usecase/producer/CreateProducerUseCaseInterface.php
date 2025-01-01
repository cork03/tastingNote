<?php

namespace App\usecase\producer;

interface CreateProducerUseCaseInterface
{
    public function handle(CreateProducerUseCaseInput $input): void;
}
