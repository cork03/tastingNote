<?php

namespace App\usecase\blindTasting;

use App\domain\BlindTastingAnswer;
use App\domain\WineComment;

class BlindTastingCreateUsecaseInput
{
    public function __construct(
        private readonly WineComment $wineComment,
        private readonly BlindTastingAnswer $blindTastingAnswer,
    )
    {
    }

    public function getWineComment(): WineComment
    {
        return $this->wineComment;
    }

    public function getBlindTastingAnswer(): BlindTastingAnswer
    {
        return $this->blindTastingAnswer;
    }
}
