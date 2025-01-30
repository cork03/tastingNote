<?php

namespace App\presenter\jsonClass;

class BlindTastingAnswerJson
{
    /**
     * @param WineVarietyJson[] $wineBlend
     */
    public function __construct(
        public readonly int         $id,
        public readonly int         $wineCommentId,
        public readonly CountryJson $country,
        public readonly int         $vintage,
        public readonly int         $price,
        public readonly float       $alcoholContent,
        public readonly array       $wineBlend,
        public readonly ?string     $anotherComment,
    )
    {
    }
}
