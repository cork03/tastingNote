<?php

namespace App\gateways\repository;

use App\domain\Producer;

interface ProducerRepositoryInterface
{
    public function create(Producer $producer): void;
}