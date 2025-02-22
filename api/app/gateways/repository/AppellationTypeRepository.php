<?php

namespace App\gateways\repository;

use App\domain\Aggregate\AppellationType;
use App\interfaceAdapter\repository\AppellationTypeRepositoryInterface;
use App\Models\AppellationType as AppellationTypeModel;
use Illuminate\Support\Facades\Log;

class AppellationTypeRepository implements AppellationTypeRepositoryInterface
{
    public function __construct(
        private readonly AppellationTypeModel $appellationTypeModel
    )
    {
    }

    public function create(AppellationType $appellationType): AppellationType
    {
        try {
            $appellationType = $this->appellationTypeModel->create([
                'name' => $appellationType->getName(),
                'country_id' => $appellationType->getCountryId(),
            ]);
            return new AppellationType(
                id: $appellationType->id,
                name: $appellationType->name,
                countryId: $appellationType->country_id
            );
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
