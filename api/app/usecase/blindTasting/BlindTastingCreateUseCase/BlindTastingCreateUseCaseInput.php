<?php

namespace App\usecase\blindTasting\BlindTastingCreateUseCase;

class BlindTastingCreateUseCaseInput
{
    public function __construct(
        private readonly WineCommentInputDTO $wineComment,
        private readonly BlindTastingAnswerInputDTO $blindTastingAnswer,
    )
    {
    }

    public function getWineComment(): WineCommentInputDTO
    {
        return $this->wineComment;
    }

    public function getBlindTastingAnswer(): BlindTastingAnswerInputDTO
    {
        return $this->blindTastingAnswer;
    }
}
