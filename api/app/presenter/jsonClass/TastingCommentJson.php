<?php

namespace App\presenter\jsonClass;

class TastingCommentJson
{
    public function __construct(
        public readonly WineCommentJson $wineCommentJson,
        public readonly ?BlindTastingAnswerJson $blindTastingAnswerJson
    )
    {
    }
}
