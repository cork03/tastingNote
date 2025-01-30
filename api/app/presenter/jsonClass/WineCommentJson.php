<?php

namespace App\presenter\jsonClass;

class WineCommentJson
{
    public function __construct(
        public readonly int    $id,
        public readonly int    $wineVintageId,
        public readonly string  $appearance,
        public readonly string  $aroma,
        public readonly string  $taste,
        public readonly ?string $anotherComment,
    )
    {
    }
}
