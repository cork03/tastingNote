<?php

namespace App\usecase\appellation;

use App\domain\Aggregate\Appellation;
use App\domain\Aggregate\AppellationType;
use App\interfaceAdapter\repository\AppellationRepositoryInterface;
use App\interfaceAdapter\repository\AppellationTypeRepositoryInterface;
use App\interfaceAdapter\repository\TransactionInterface;

class AppellationCreateUseCase implements AppellationCreateUseCaseInterface
{
    public function __construct(
        private readonly AppellationRepositoryInterface $appellationRepository,
        private readonly AppellationTypeRepositoryInterface $appellationTypeRepository,
        private readonly TransactionInterface $transaction
    )
    {
    }

    public function handle(AppellationCreateUseCaseInput $input): void
    {
        if ($input->getAppellationTypeId() === null) {
            $this->transaction->transaction(function () use ($input) {
                $appellationType = $this->appellationTypeRepository->create(
                    new AppellationType(
                        id: null,
                        name: $input->getAppellationTypeName(),
                        countryId: $input->getCountryId(),
                    )
                );
                $this->appellationRepository->create(new Appellation(
                    id: null,
                    name: $input->getName(),
                    regulation: $input->getRegulation(),
                    appellationTypeId: $appellationType->getId()
                ));
            });
            return;
        }

        $this->appellationRepository->create(new Appellation(
            id: null,
            name: $input->getName(),
            regulation: $input->getRegulation(),
            appellationTypeId: $input->getAppellationTypeId()
        ));
    }
}
