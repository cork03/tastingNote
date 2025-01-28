<?php

namespace App\usecase\wineVintage;

use App\domain\WineComment;
use App\gateways\repository\wineVintage\WineCommentRepositoryInterface;

class CreateWineCommentUseCase implements CreateWineCommentUseCaseInterface
{
    public function __construct(private readonly WineCommentRepositoryInterface $wineCommentRepository)
    {
    }

    public function handle(WineComment $wineComment): void
    {
        $this->wineCommentRepository->create($wineComment);
    }
}
