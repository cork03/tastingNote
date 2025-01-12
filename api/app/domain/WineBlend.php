<?php

namespace App\domain;

use Exception;

class WineBlend
{
    /**
     * @var WineVariety[]
     */
    private readonly array $wineVarieties;

    /**
     * @param WineVariety[] $wineVarieties
     * @throws Exception
     */
    public function __construct(array $wineVarieties)
    {
        $totalPercent = 0;
        $ids = [];
        foreach ($wineVarieties as $wineVariety) {
            $totalPercent += $wineVariety->getPercent();
            $ids[] = $wineVariety->getGrapeVariety()->getId();
        }
        if (count($ids) !== count(array_unique($ids))) {
            throw new Exception('同じブドウ品種が複数含まれています');
        }
        if ($totalPercent > 100) {
            throw new Exception('ワインのブレンドの合計が100%を超えています');
        }
        $this->wineVarieties = $wineVarieties;
    }

    /**
     * @return WineVariety[]
     */
    public function getWineVarieties(): array
    {
        return $this->wineVarieties;
    }
}
