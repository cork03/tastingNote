<?php

namespace App\gateways\repository;

use App\domain\BlindTastingAnswer;
use App\domain\Country;
use App\domain\GrapeVariety;
use App\domain\Producer;
use App\domain\TastingComment;
use App\domain\Wine;
use App\domain\WineBlend;
use App\domain\WineComment;
use App\domain\WineType;
use App\domain\WineVariety;
use App\domain\WineVintage;
use App\domain\WineVintageFullInfo;
use App\Models\BlindTastingAnswer as BlindTastingAnswerModel;
use App\Models\WineVintage as WineVintageModel;
use App\Models\WineComment as WineCommentModel;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function Termwind\renderUsing;

class WineVintageRepository implements WineVintageRepositoryInterface
{
    public function __construct(
        private readonly WineVintageModel $wineVintageModel,
        private readonly WineCommentModel $wineCommentModel
    )
    {
    }

    /**
     * @throws Exception
     */
    public function create(WineVintage $wineVintage, ?string $imagePath): void
    {
        try {
            DB::transaction(function () use ($wineVintage, $imagePath) {
                $wineVintageModel = $this->wineVintageModel->create([
                    'wine_id' => $wineVintage->getWineId(),
                    'vintage' => $wineVintage->getVintage(),
                    'price' => $wineVintage->getPrice(),
                    'aging_method' => $wineVintage->getAgingMethod(),
                    'alcohol_content' => $wineVintage->getAlcoholContent(),
                    'technical_comment' => $wineVintage->getTechnicalComment(),
                    'image_path' => $imagePath,
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
            ->with(['wine.country', 'wine.producer.country', 'grapeVarieties'])
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
                name: $producerEntity->name,
                country: new Country(
                    id: $producerEntity->country->id,
                    name: $producerEntity->country->name
                ),
                description: $producerEntity->description,
                url: $producerEntity->url
            ),
            vintage: $wineVintageEntity->vintage,
            price: $wineVintageEntity->price,
            agingMethod: $wineVintageEntity->aging_method,
            alcoholContent: $wineVintageEntity->alcohol_content,
            wineBlend: new WineBlend($grapeVarieties),
            technicalComment: $wineVintageEntity->technical_comment,
            imagePath: $wineVintageEntity->image_path
        );
    }

    /**
     * @return TastingComment[]
     */
    public function getWineCommentsByWineVintageId(int $wineVintageId): array
    {
        /** @var Collection $wineCommentModels */
        $wineCommentModels = $this->wineCommentModel
            ->with(['blindTastingAnswer.grapeVarieties', 'blindTastingAnswer.country'])
            ->where('wine_vintage_id', $wineVintageId)
            ->get();

        $tastingComments = [];
        /** @var WineCommentModel $wineCommentModel */
        foreach ($wineCommentModels as $wineCommentModel) {
            $wineComment = new WineComment(
                id: $wineCommentModel->id,
                wineVintageId: $wineCommentModel->wine_vintage_id,
                appearance: $wineCommentModel->appearance,
                aroma: $wineCommentModel->aroma,
                taste: $wineCommentModel->taste,
                anotherComment: $wineCommentModel->another_comment
            );
            /** @var BlindTastingAnswerModel $blindTastingAnswer */
            $blindTastingAnswerModel = $wineCommentModel->blindTastingAnswer;
            if (!isset($wineCommentModel->blindTastingAnswer)) {
                $tastingComments[] = new TastingComment(
                    wineComment: $wineComment,
                    blindTastingAnswer: null
                );
                continue;
            }

            $grapeVarieties = [];
            foreach ($blindTastingAnswerModel->grapeVarieties as $grapeVariety) {
                $grapeVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $grapeVariety->id,
                        name: $grapeVariety->name
                    ),
                    percentage: $grapeVariety->pivot->percentage
                );
            }

             $blindTastingAnswer = new BlindTastingAnswer(
                id: $blindTastingAnswerModel->id,
                wineCommentId: $blindTastingAnswerModel->wine_comment_id,
                country: new Country(
                    id: $blindTastingAnswerModel->country->id,
                    name: $blindTastingAnswerModel->country->name
                ),
                vintage: $blindTastingAnswerModel->vintage,
                price: $blindTastingAnswerModel->price,
                alcoholContent: $blindTastingAnswerModel->alcohol_content,
                wineBlend: new WineBlend($grapeVarieties),
                anotherComment: $blindTastingAnswerModel->another_comment
            );
            $tastingComments[] = new TastingComment(
                wineComment: $wineComment,
                blindTastingAnswer: $blindTastingAnswer
            );
        }
        return $tastingComments;
    }
}
