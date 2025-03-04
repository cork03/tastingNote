<?php

namespace App\usecase\blindTasting\BlindTastingCreateUseCase;

use App\domain\Aggregate\BlindTastingAnswer;
use App\domain\Aggregate\WineComment;
use App\interfaceAdapter\repository\BlindTastingAnswerRepositoryInterface;
use App\interfaceAdapter\repository\TransactionInterface;
use App\interfaceAdapter\repository\WineCommentRepositoryInterface;

class BlindTastingCreateUseCase implements BlindTastingCreateUseCaseInterface
{
    public function __construct(
        private readonly WineCommentRepositoryInterface        $wineCommentRepository,
        private readonly BlindTastingAnswerRepositoryInterface $blindTastingAnswerRepository,
        private readonly TransactionInterface                  $transaction
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function handle(BlindTastingCreateUseCaseInput $input): int
    {
        try {
            $id = $this->transaction->transaction(
                function () use ($input) {
                    $wineCommentDTO = $input->getWineComment();
                    $wineComment = $this->wineCommentRepository->create(
                        new WineComment(
                            id: null,
                            wineVintageId: null,
                            appearance: $wineCommentDTO->getAppearance(),
                            aroma: $wineCommentDTO->getAroma(),
                            taste: $wineCommentDTO->getTaste(),
                            anotherComment: $wineCommentDTO->getAnotherComment()
                        )
                    );
                    $blindTastingAnswerDTO = $input->getBlindTastingAnswer();
                    $this->blindTastingAnswerRepository->create(
                        new BlindTastingAnswer(
                            id: null,
                            wineCommentId: $wineComment->getId(),
                            countryId: $blindTastingAnswerDTO->getCountryId(),
                            vintage: $blindTastingAnswerDTO->getVintage(),
                            price: $blindTastingAnswerDTO->getPrice(),
                            alcoholContent: $blindTastingAnswerDTO->getAlcoholContent(),
                            wineBlend: $blindTastingAnswerDTO->getWineBlend(),
                            anotherComment: $blindTastingAnswerDTO->getAnotherComment()
                        )
                    );
                    return $wineComment->getId();
                });
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
        return $id;
    }
}
