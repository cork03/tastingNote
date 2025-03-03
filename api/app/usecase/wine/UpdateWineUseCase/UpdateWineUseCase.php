<?php

namespace App\usecase\wine\UpdateWineUseCase;

use App\domain\Aggregate\Wine;
use App\gateways\repository\WineRepositoryInterface;
use App\interfaceAdapter\queryService\UpdateWineUseCaseQueryServiceInterface;
use Illuminate\Support\Facades\Log;

class UpdateWineUseCase implements UpdateWineUseCaseInterface
{
    public function __construct(
        private readonly WineRepositoryInterface $wineRepository,
        private readonly UpdateWineUseCaseQueryServiceInterface $updateWineUseCaseQueryService
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function handle(UpdateWineUseCaseInput $input): void
    {
        try {
            if ($input->getAppellationId() === null) {
                $this->wineRepository->update(new Wine(
                    id: $input->getId(),
                    name: $input->getName(),
                    producerId: $input->getProducerId(),
                    wineTypeId: $input->getWineTypeId(),
                    countryId: $input->getCountryId(),
                    appellationId: null,
                ));
                return;
            }
            $appellationCountryId = $this->updateWineUseCaseQueryService->getAppellationCountryId($input->getAppellationId());
            if ($appellationCountryId === null) {
                throw new \Exception('Appellation not found');
            }
            $wine = new Wine(
                id: $input->getId(),
                name: $input->getName(),
                producerId: $input->getProducerId(),
                wineTypeId: $input->getWineTypeId(),
                countryId: $input->getCountryId(),
                appellationId: $input->getAppellationId(),
            );
            $wine->validateAppellation($appellationCountryId);
            $this->wineRepository->update($wine);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }
}
