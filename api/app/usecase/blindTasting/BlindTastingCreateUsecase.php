<?php

namespace App\usecase\blindTasting;

use App\gateways\repository\blindTasting\BlindTastingRepository;
use App\gateways\repository\blindTasting\BlindTastingRepositoryInterface;

class BlindTastingCreateUsecase implements BlindTastingCreateUsecaseInterface
{
    public function __construct(private readonly BlindTastingRepositoryInterface $blindTastingRepository)
    {
    }

    public function handle(BlindTastingCreateUsecaseInput $input): void
    {
        $this->blindTastingRepository->create($input->getWineComment(), $input->getBlindTastingAnswer());
    }
}
