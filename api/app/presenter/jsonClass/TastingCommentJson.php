<?php

namespace App\presenter\jsonClass;

class TastingCommentJson
{
    public function __construct(
        public readonly WineCommentJson $wineComment,
        public readonly ?BlindTastingAnswerJson $blindTastingAnswer
    )
    {
    }
}
