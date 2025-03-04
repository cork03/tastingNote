<?php

namespace App\gateways\repository;

use App\domain\Aggregate\BlindTastingAnswer;
use App\Models\BlindTastingAnswer as BlindTastingAnswerModel;
use App\interfaceAdapter\repository\BlindTastingAnswerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlindTastingAnswerRepository implements BlindTastingAnswerRepositoryInterface
{
    public function __construct(private readonly BlindTastingAnswerModel $blindTastingAnswerModel)
    {
    }

    /**
     * @throws \Exception
     */
    public function create(BlindTastingAnswer $blindTastingAnswer): void
    {
        try {
            DB::transaction(function () use ($blindTastingAnswer) {
                /** @var BlindTastingAnswerModel $blindTastingAnswerModel */
                $blindTastingAnswerModel = $this->blindTastingAnswerModel->create([
                    'wine_comment_id' => $blindTastingAnswer->getWineCommentId(),
                    'country_id' => $blindTastingAnswer->getCountryId(),
                    'vintage' => $blindTastingAnswer->getVintage(),
                    'price' => $blindTastingAnswer->getPrice(),
                    'alcohol_content' => $blindTastingAnswer->getAlcoholContent(),
                    'another_comment' => $blindTastingAnswer->getAnotherComment(),
                ]);
                $blindTastingWineVarieties = [];
                foreach ($blindTastingAnswer->getWineBlend()->getWineVarieties() as $grapeVariety) {
                    $blindTastingWineVarieties[$grapeVariety->getGrapeVariety()->getId()] = [
                        'percentage' => $grapeVariety->getPercentage(),
                    ];
                }
                $blindTastingAnswerModel->grapeVarieties()->attach($blindTastingWineVarieties);
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            throw new \Exception($e->getMessage());
        }

    }
}
