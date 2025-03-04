<?php

namespace App\usecase\wineVintage;

use App\domain\Aggregate\WineComment;
use App\domain\WineComment as WineCommentDomain;
use App\interfaceAdapter\repository\WineCommentRepositoryInterface;

class CreateWineCommentUseCase implements CreateWineCommentUseCaseInterface
{
    public function __construct(private readonly WineCommentRepositoryInterface $wineCommentRepository)
    {
    }

    public function handle(WineCommentDomain $wineComment): void
    {
        $this->wineCommentRepository->create(
            new WineComment(
                id: null,
                wineVintageId: $wineComment->getWineVintageId(),
                appearance: $wineComment->getAppearance(),
                aroma: $wineComment->getAroma(),
                taste: $wineComment->getTaste(),
                anotherComment: $wineComment->getAnotherComment()
            )
        );
    }
}
