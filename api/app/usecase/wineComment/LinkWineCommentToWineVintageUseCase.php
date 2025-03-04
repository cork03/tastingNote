<?php

namespace App\usecase\wineComment;

use App\interfaceAdapter\repository\WineCommentRepositoryInterface;

class LinkWineCommentToWineVintageUseCase implements LinkWineCommentToWineVintageUseCaseInterface
{
    public function __construct(private readonly WineCommentRepositoryInterface $wineCommentRepository)
    {
    }

    public function handle(int $wineCommentId, int $wineVintageId): void
    {
        $this->wineCommentRepository->linkToWineVintage($wineCommentId, $wineVintageId);
    }
}
