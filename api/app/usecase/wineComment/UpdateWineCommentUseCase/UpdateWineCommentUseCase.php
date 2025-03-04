<?php

namespace App\usecase\wineComment\UpdateWineCommentUseCase;

use App\domain\Aggregate\WineComment;
use App\interfaceAdapter\repository\WineCommentRepositoryInterface;

class UpdateWineCommentUseCase implements UpdateWineCommentUseCaseInterface
{
    public function __construct(
        private readonly WineCommentRepositoryInterface $wineCommentRepository
    )
    {
    }

    public function handle(UpdateWineCommentUseCaseInput $input): void
    {
        try {
            $this->wineCommentRepository->update(
                new WineComment(
                    id: $input->getId(),
                    wineVintageId: $input->getWineVintageId(),
                    appearance: $input->getAppearance(),
                    aroma: $input->getAroma(),
                    taste: $input->getTaste(),
                    anotherComment: $input->getAnotherComment()
                )
            );
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
