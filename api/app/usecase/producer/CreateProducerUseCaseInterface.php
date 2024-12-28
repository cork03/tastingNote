<?php

namespace App\usecase\producer;

interface CreateProducerUseCaseInterface
{
    public function handle(CreateProducerUsaCaseInput $input): void;
}
