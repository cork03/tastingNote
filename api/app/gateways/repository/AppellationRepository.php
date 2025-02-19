<?php

namespace App\gateways\repository;

use App\domain\Aggregate\Appellation;
use App\domain\Aggregate\AppellationType;
use App\domain\Appellation as AppellationDomain;
use App\domain\AppellationType as AppellationTypeDomain;
use App\domain\Country;
use App\Models\Appellation as AppellationModel;
use App\Models\AppellationType as AppellationTypeModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppellationRepository implements AppellationRepositoryInterface
{
    public function __construct(
        private readonly AppellationModel     $appellationModel,
        private readonly AppellationTypeModel $appellationTypeModel,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function create(AppellationDomain $appellation): void
    {
        try {
            $this->appellationModel->create([
                'name' => $appellation->getName(),
                'regulation' => $appellation->getRegulation(),
                'appellation_type_id' => $appellation->getAppellationType()->getId(),
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public function createWithAppellationType(AppellationDomain $appellation): void
    {
        try {
            DB::transaction(function () use ($appellation) {
                $appellationType = $appellation->getAppellationType();
                $appellationTypeModel = $this->appellationTypeModel->create([
                    'name' => $appellationType->getName(),
                    'country_id' => $appellationType->getCountry()->getId(),
                ]);
                $this->appellationModel->create([
                    'name' => $appellation->getName(),
                    'regulation' => $appellation->getRegulation(),
                    'appellation_type_id' => $appellationTypeModel->id,
                ]);
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @return AppellationTypeDomain[]
     */
    public function getAppellationTypes(): array
    {
        /**
         * @var Collection $appellationTypesModel
         */
        $appellationTypesModel = $this->appellationTypeModel->with('country')->get();
        $appellationTypes = [];
        foreach ($appellationTypesModel as $appellationTypeModel) {
            $appellationTypes[] = new AppellationTypeDomain(
                id: $appellationTypeModel->id,
                name: $appellationTypeModel->name,
                country: new Country(
                    id: $appellationTypeModel->country->id,
                    name: $appellationTypeModel->country->name
                )
            );
        }
        return $appellationTypes;
    }

    public function getById(int $getAppellationId): ?Appellation
    {
        $appellationModel = $this->appellationModel->with('appellationType')->find($getAppellationId);
        return new Appellation(
            id: $appellationModel->id,
            name: $appellationModel->name,
            regulation: $appellationModel->regulation,
            appellationType: new AppellationType(
                id: $appellationModel->appellationType->id,
                name: $appellationModel->appellationType->name,
                countryId: $appellationModel->appellationType->country_id
            )
        );
    }
}
