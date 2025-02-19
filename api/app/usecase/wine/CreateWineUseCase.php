<?php

namespace App\usecase\wine;

use App\domain\Aggregate\Wine;
use App\gateways\repository\AppellationRepositoryInterface;
use App\gateways\repository\WineRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CreateWineUseCase implements CreateWineUseCaseInterface
{
    public function __construct(
        private readonly WineRepositoryInterface        $wineRepository,
        private readonly AppellationRepositoryInterface $appellationRepository
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function handle(CreateWineUseCaseInput $input): Wine
    {
        try {
            if ($input->getAppellationId() === null) {
                return $this->wineRepository->create(new Wine(
                    id: null,
                    name: $input->getName(),
                    producerId: $input->getProducerId(),
                    wineTypeId: $input->getWineTypeId(),
                    countryId: $input->getCountryId(),
                    appellationId: null,
                ));
            }
            $wine = new Wine(
                id: null,
                name: $input->getName(),
                producerId: $input->getProducerId(),
                wineTypeId: $input->getWineTypeId(),
                countryId: $input->getCountryId(),
                appellationId: $input->getAppellationId(),
            );
            $appellation = $this->appellationRepository->getById($input->getAppellationId());
            if ($appellation === null) {
                throw new \Exception('Appellation not found');
            }
            $wine->validateAppellation($appellation);
            return $this->wineRepository->create($wine);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }
}
