<?php

namespace App\usecase\appellation;

use App\domain\Appellation;
use App\gateways\repository\AppellationRepositoryInterface;

class AppellationCreateUseCase implements AppellationCreateUseCaseInterface
{
    public function __construct(private readonly AppellationRepositoryInterface $appellationRepository)
    {
    }

    public function handle(Appellation $appellation): void
    {
        // appellationTypeのidがない場合はTypeの登録も行う。
        if ($appellation->getAppellationType()->getId() === null) {
            // AppellationTypeの登録処理
            $this->appellationRepository->createWithAppellationType($appellation);
            return;
        }
        $this->appellationRepository->create($appellation);
    }
}
