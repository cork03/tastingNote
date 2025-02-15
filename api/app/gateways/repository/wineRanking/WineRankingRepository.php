<?php

namespace App\gateways\repository\wineRanking;

use App\domain\Country;
use App\domain\GrapeVariety;
use App\domain\Wine;
use App\domain\WineBlend;
use App\domain\WineRanking;
use App\domain\WineType;
use App\domain\WineVariety;
use App\domain\WineVintage;
use App\Models\WineRanking as WineRankingModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class WineRankingRepository implements WineRankingRepositoryInterface
{
    public function __construct(private readonly WineRankingModel $wineRankingModel)
    {
    }

    /**
     * @throws \Exception
     */
    public function create(int $wineVintageId, int $rank, WineType $wineType): void
    {
        try {
            DB::transaction(function () use ($wineVintageId, $rank, $wineType) {
                $this->wineRankingModel
                    ->where('rank', '>=', $rank)
                    ->where('wine_type_id', $wineType->value)
                    ->orderBy('rank', 'desc')->increment('rank');
                $this->wineRankingModel->create([
                    'wine_vintage_id' => $wineVintageId,
                    'rank' => $rank,
                    'wine_type_id' => $wineType->value,
                ]);
            });
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @return array<array{wineRank: WineRanking, wineVintage: WineVintage, wine: Wine}>
     * @throws \Exception
     */
    public function get(WineType $wineType): array
    {
        /**
         * @var Collection $wineRankingModels
         */
        $wineRankingModels = $this->wineRankingModel
            ->where('wine_type_id', $wineType->value)
            ->with(['wineVintage.grapeVarieties', 'wineType', 'wineVintage.wine'])
            ->orderBy('rank')
            ->get();
        $wineRanksInfo = [];
        foreach ($wineRankingModels as $wineRankingModel) {
            $wineVintage = $wineRankingModel->wineVintage;
            $grapeVarieties = [];
            foreach ($wineVintage->grapeVarieties as $grapeVariety) {
                $grapeVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $grapeVariety->id,
                        name: $grapeVariety->name
                    ),
                    percentage: $grapeVariety->pivot->percentage
                );
            }
            $wine = $wineVintage->wine;
            $wineRanksInfo[] = [
                'wineRank' => new WineRanking(
                    id: $wineRankingModel->id,
                    rank:$wineRankingModel->rank,
                    wineVintageId: $wineRankingModel->wine_vintage_id,
                    wineType: WineType::fromId($wineRankingModel->wineType->id)
                ),
                'wineVintage' => new WineVintage(
                    id: $wineVintage->id,
                    wineId: $wineVintage->wine_id,
                    vintage: $wineVintage->vintage,
                    price: $wineVintage->price,
                    agingMethod: $wineVintage->aging_method,
                    alcoholContent: $wineVintage->alcohol_content,
                    wineBlend: new WineBlend($grapeVarieties),
                    technicalComment: $wineVintage->technical_comment,
                    imagePath: $wineVintage->image_path,
                ),
                'wine' => new Wine(
                    id: $wine->id,
                    name: $wine->name,
                    producerId: $wine->producer_id,
                    wineType: WineType::fromId($wine->wine_type_id),
                    country: new Country(
                        id: $wine->country->id,
                        name: $wine->country->name
                    ),
                )
            ];
        }
        return $wineRanksInfo;
    }

    /**
     * @return WineRanking[]
     * @throws \Exception
     */
    public function getAll(): array
    {
        $wineRankingModels = $this->wineRankingModel->get();
        $wineRanks = [];
        foreach ($wineRankingModels as $wineRankingModel) {
            $wineRanks[] = new WineRanking(
                id: $wineRankingModel->id,
                rank: $wineRankingModel->rank,
                wineVintageId: $wineRankingModel->wine_vintage_id,
                wineType: WineType::fromId($wineRankingModel->wine_type_id),
            );
        }
        return $wineRanks;
    }
}
