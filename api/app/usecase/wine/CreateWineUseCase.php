<?php

namespace App\usecase\wine;

use App\domain\Aggregate\Wine;
use App\gateways\repository\WineRepositoryInterface;
use App\interfaceAdapter\queryService\CreateWineUseCaseQueryServiceInterface;
use Illuminate\Support\Facades\Log;

class CreateWineUseCase implements CreateWineUseCaseInterface
{
    public function __construct(
        private readonly WineRepositoryInterface                 $wineRepository,
        private readonly CreateWineUseCaseQueryServiceInterface $createWineUseCaseQueryService
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
            $appellationCountryId = $this->createWineUseCaseQueryService->getAppellationCountryId($input->getAppellationId());
            if ($appellationCountryId === null) {
                throw new \Exception('Appellation not found');
            }
            $wine = new Wine(
                id: null,
                name: $input->getName(),
                producerId: $input->getProducerId(),
                wineTypeId: $input->getWineTypeId(),
                countryId: $input->getCountryId(),
                appellationId: $input->getAppellationId(),
            );
            $wine->validateAppellation($appellationCountryId);
            return $this->wineRepository->create($wine);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }
}
