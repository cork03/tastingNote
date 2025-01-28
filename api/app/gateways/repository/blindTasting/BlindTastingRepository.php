<?php

namespace App\gateways\repository\blindTasting;

use App\domain\BlindTastingAnswer;
use App\domain\WineComment;
use App\Models\WineComment as WineCommentModel;
use App\Models\BlindTastingAnswer as BlindTastingAnswerModel;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BlindTastingRepository implements BlindTastingRepositoryInterface
{
    public function __construct(
        private readonly WineCommentModel $wineCommentModel,
        private readonly BlindTastingAnswerModel $blindTastingAnswerModel
    )
    {
    }

    /**
     * @throws Exception
     */
    public function create(WineComment $wineComment, BlindTastingAnswer $blindTastingAnswer): void
    {
        try {
            DB::transaction(function () use ($wineComment, $blindTastingAnswer) {
                /** @var WineCommentModel $wineCommentModel */
                $wineCommentModel = $this->wineCommentModel->create([
                    'appearance' => $wineComment->getAppearance(),
                    'aroma' => $wineComment->getAroma(),
                    'taste' => $wineComment->getTaste(),
                    'another_comment' => $wineComment->getAnotherComment()
                ]);
                /** @var BlindTastingAnswerModel $blindTastingAnswerModel */
                $blindTastingAnswerModel =$this->blindTastingAnswerModel->create([
                    'wine_comment_id' => $wineCommentModel->id,
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
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
