<?php

namespace App\usecase\gateways\repository;

use App\domain\Producer;
use App\Models\Producer as ProducerModel;
use Exception;
use Illuminate\Support\Facades\Log;

class ProducerRepository implements ProducerRepositoryInterface
{
    public function __construct(private readonly ProducerModel $producerModel)
    {
    }

    /**
     * @throws Exception
     */
    public function create(Producer $producer): void
    {
        try {
            $this->producerModel->create([
                'name' => $producer->getName()
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }

    }
}
