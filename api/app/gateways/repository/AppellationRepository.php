<?php

namespace App\gateways\repository;

use App\domain\Aggregate\Appellation;
use App\interfaceAdapter\repository\AppellationRepositoryInterface;
use App\Models\Appellation as AppellationModel;
use Illuminate\Support\Facades\Log;

class AppellationRepository implements AppellationRepositoryInterface
{
    public function __construct(
        private readonly AppellationModel     $appellationModel,

    )
    {
    }

    /**
     * @throws \Exception
     */
    public function create(Appellation $appellation): void
    {
        try {
            $this->appellationModel->create([
                'name' => $appellation->getName(),
                'regulation' => $appellation->getRegulation(),
                'appellation_type_id' => $appellation->getAppellationTypeId(),
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
