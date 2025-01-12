<?php

namespace App\gateways\repository;

use App\domain\WineVintage;
use App\Models\WineVintage as WineVintageModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WineVintageRepository implements WineVintageRepositoryInterface
{
    public function __construct(private readonly WineVintageModel $wineVintageModel)
    {
    }

    /**
     * @throws Exception
     */
    public function create(WineVintage $wineVintage): void
    {
        try {
            DB::transaction(function () use ($wineVintage){
                $wineVintageModel = $this->wineVintageModel->create([
                    'wine_id' => $wineVintage->getWineId(),
                    'vintage' => $wineVintage->getVintage(),
                    'price' => $wineVintage->getPrice(),
                    'aging_method' => $wineVintage->getAgingMethod(),
                    'alcohol_content' => $wineVintage->getAlcoholContent(),
                    'technical_comment' => $wineVintage->getTechnicalComment(),
                ]);
                $wineVarieties = [];
                foreach ($wineVintage->getWineBlend()->getWineVarieties() as $grapeVariety) {
                    $wineVarieties[$grapeVariety->getGrapeVariety()->getId()] = [
                        'percentage' => $grapeVariety->getPercent(),
                        'is_about' => $grapeVariety->getIsAbout(),
                    ];
                }
                $wineVintageModel->grapeVarieties()->attach($wineVarieties);
            });
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
