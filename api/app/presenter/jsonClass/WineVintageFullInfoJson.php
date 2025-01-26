<?php

namespace App\presenter\jsonClass;

use App\domain\Producer;

class WineVintageFullInfoJson
{
    /**
     * @param WineVarietyJson[] $wineBlend
     */
    public function __construct(
        public readonly int $id,
        public readonly ProducerJson $producer,
        public readonly WineJson $wine,
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
