<?php

namespace App\usecase\wineVintage;

use App\gateways\repository\WineVintageRepositoryInterface;

class GetWineCommentsUseCase implements GetWineCommentsUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository
    ) {
    }

    public function handle(int $wineVintageId): array
    {
        return $this->wineVintageRepository->getWineCommentsByWineVintageId($wineVintageId);
    }
}
