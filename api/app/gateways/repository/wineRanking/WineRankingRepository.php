<?php

namespace App\gateways\repository\wineRanking;

use App\Models\WineRanking;
use Illuminate\Support\Facades\DB;

class WineRankingRepository implements WineRankingRepositoryInterface
{
    public function __construct(private readonly WineRanking $wineRanking)
    {
    }

    /**
     * @throws \Exception
     */
    public function create(int $wineVintageId, int $rank): void
    {
        try {
            DB::transaction(function () use ($wineVintageId, $rank) {
                $this->wineRanking->where('rank', '>=', $rank)->orderBy('rank', 'desc')->increment('rank');
                $this->wineRanking->create([
                    'wine_vintage_id' => $wineVintageId,
                    'rank' => $rank,
                ]);
            });
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
