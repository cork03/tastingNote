<?php

namespace App\presenter\jsonClass;

class WineVintageJson
{
    /**
     * @param WineVarietyJson[] $wineBlend
     */
    public function __construct(
        public readonly int $id,
        public readonly int $wineId,
        public readonly int $vintage,
        public readonly int $price,
        public readonly string $agingMethod,
        public readonly float $alcoholContent,
        public readonly array $wineBlend,
        public readonly ?string $technicalComment
    )
    {
    }
}
