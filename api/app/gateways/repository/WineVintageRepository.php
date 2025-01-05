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
                    'country_id' => $wineVintage->getCountryId(),
                    'price' => $wineVintage->getPrice(),
                    'aging_method' => $wineVintage->getAgingMethod(),
                    'alcohol_content' => $wineVintage->getAlcoholContent(),
                    'technical_comment' => $wineVintage->getTechnicalComment(),
                ]);
                $wineVintageModel->grapeVarieties()->attach($wineVintage->getGrapeVarieties());
            });
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
