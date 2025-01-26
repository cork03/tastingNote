<?php

namespace App\gateways\repository;

use App\domain\Country;
use App\domain\GrapeVariety;
use App\domain\Producer;
use App\domain\Wine;
use App\domain\WineBlend;
use App\domain\WineType;
use App\domain\WineVariety;
use App\domain\WineVintage;
use App\domain\WineVintageFullInfo;
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
            DB::transaction(function () use ($wineVintage) {
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
                        'percentage' => $grapeVariety->getPercentage(),
                    ];
                }
                $wineVintageModel->grapeVarieties()->attach($wineVarieties);
            });
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getWithWineByWineIdAndVintage(int $wineId, int $vintage): WineVintageFullInfo
    {
        $wineVintageEntity = $this->wineVintageModel
            ->with(['wine.country', 'wine.producer', 'grapeVarieties'])
            ->where('wine_id', $wineId)
            ->where('vintage', $vintage)
            ->first();
        if (!isset($wineVintageEntity)) {
            throw new Exception('WineVintage not found');
        }

        $grapeVarieties = [];
        foreach ($wineVintageEntity->grapeVarieties as $grapeVariety) {
            $grapeVarieties[] = new WineVariety(
                grapeVariety: new GrapeVariety(
                    id: $grapeVariety->id,
                    name: $grapeVariety->name
                ),
                percentage: $grapeVariety->pivot->percentage
            );
        }

        $wineEntity = $wineVintageEntity->wine;
        $producerEntity = $wineEntity->producer;
        return new WineVintageFullInfo(
            id: $wineVintageEntity->id,
            wine: new Wine(
                id: $wineEntity->id,
                name: $wineEntity->name,
                producerId: $wineEntity->producer_id,
                wineType: WineType::fromId($wineEntity->wine_type_id),
                country: new Country(
                    id: $wineEntity->country->id,
                    name: $wineEntity->country->name
                )
            ),
            producer: new Producer(
                id: $producerEntity->id,
                name: $producerEntity->name
            ),
            vintage: $wineVintageEntity->vintage,
            price: $wineVintageEntity->price,
            agingMethod: $wineVintageEntity->aging_method,
            alcoholContent: $wineVintageEntity->alcohol_content,
            wineBlend: new WineBlend($grapeVarieties),
            technicalComment: $wineVintageEntity->technical_comment
        );
    }
}
