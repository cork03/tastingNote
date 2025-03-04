<?php

namespace App\usecase\wineComment\CreateWineCommentUseCase;

use App\domain\Aggregate\WineComment;
use App\interfaceAdapter\repository\WineCommentRepositoryInterface;

class CreateWineCommentUseCase implements CreateWineCommentUseCaseInterface
{
    public function __construct(private readonly WineCommentRepositoryInterface $wineCommentRepository)
    {
    }

    public function handle(CreateWineCommentUseCaseInput $input): void
    {
        $this->wineCommentRepository->create(
            new WineComment(
                id: null,
                wineVintageId: $input->getWineVintageId(),
                appearance: $input->getAppearance(),
                aroma: $input->getAroma(),
                taste: $input->getTaste(),
                anotherComment: $input->getAnotherComment()
            )
        );
    }
}
