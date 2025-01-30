<?php

namespace App\domain;

class TastingComment
{
    public function __construct(
        private readonly WineComment $wineComment,
        private readonly ?BlindTastingAnswer $blindTastingAnswer
    )
    {
    }

    public function getWineComment(): WineComment
    {
        return $this->wineComment;
    }

    public function getBlindTastingAnswer(): ?BlindTastingAnswer
    {
        return $this->blindTastingAnswer;
    }
}
