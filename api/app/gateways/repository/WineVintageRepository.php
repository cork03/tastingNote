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
    public function createAndLinkComment(WineVintage $wineVintage, ?string $imagePath, int $commentId): void
    {
        try {
            DB::transaction(function () use ($wineVintage, $imagePath, $commentId) {
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
                $updatedRows = $this->wineCommentModel->where('id', $commentId)->update(['wine_vintage_id' => $wineVintageModel->id]);
                if ($updatedRows === 0) {
                    throw new Exception("id:{$commentId}に該当するcommentが見つかりません");
                }
            });
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function update(WineVintage $wineVintage, ?string $imagePath): void
    {
        try {
            DB::transaction(function () use ($wineVintage, $imagePath) {
                /** @var ?WineVintageModel $wineVintageModel */
                $wineVintageModel = $this->wineVintageModel->find($wineVintage->getId());
                if (!isset($wineVintageModel)) {
                    throw new Exception('該当のwineVintageが見つかりません');
                }
                $updateArray = [
                    'wine_id' => $wineVintage->getWineId(),
                    'vintage' => $wineVintage->getVintage(),
                    'price' => $wineVintage->getPrice(),
                    'aging_method' => $wineVintage->getAgingMethod(),
                    'alcohol_content' => $wineVintage->getAlcoholContent(),
                    'technical_comment' => $wineVintage->getTechnicalComment(),
                ];
                if (isset($imagePath)) {
                    $updateArray['image_path'] = $imagePath;
                }
                $wineVintageModel->update($updateArray);
                $wineVarieties = [];
                foreach ($wineVintage->getWineBlend()->getWineVarieties() as $grapeVariety) {
                    $wineVarieties[$grapeVariety->getGrapeVariety()->getId()] = [
                        'percentage' => $grapeVariety->getPercentage(),
                    ];
                }
                $wineVintageModel->grapeVarieties()->sync($wineVarieties);
            });
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    public function getById(int $id): ?WineVintage
    {
        /**
         * @var ?WineVintageModel $wineVintageModel
         */
        $wineVintageModel = $this->wineVintageModel->with("grapeVarieties")->find($id);
        if (!isset($wineVintageModel)) {
            return null;
        }
        $grapeVarieties = [];
        foreach ($wineVintageModel->grapeVarieties as $grapeVariety) {
            $grapeVarieties[] = new WineVariety(
                grapeVariety: new GrapeVariety(
                    id: $grapeVariety->id,
                    name: $grapeVariety->name
                ),
                percentage: $grapeVariety->pivot->percentage
            );
        }
        return new WineVintage(
            id: $wineVintageModel->id,
            wineId: $wineVintageModel->wine_id,
            vintage: $wineVintageModel->vintage,
            price: $wineVintageModel->price,
            agingMethod: $wineVintageModel->aging_method,
            alcoholContent: $wineVintageModel->alcohol_content,
            wineBlend: new WineBlend($grapeVarieties),
            technicalComment: $wineVintageModel->technical_comment,
            imagePath: $wineVintageModel->image_path
        );
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

    /**
     * @return WineVintage[]
     */
    public function getAllById(int $wineId): array
    {
        /** @var Collection $wineVintageModels */
        $wineVintageModels = $this->wineVintageModel->where('wine_id', $wineId)->get();
        $wineVintages = [];
        foreach ($wineVintageModels as $wineVintageModel) {
            $grapeVarieties = [];
            foreach ($wineVintageModel->grapeVarieties as $grapeVariety) {
                $grapeVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $grapeVariety->id,
                        name: $grapeVariety->name
                    ),
                    percentage: $grapeVariety->pivot->percentage
                );
            }
            $wineVintages[] = new WineVintage(
                id: $wineVintageModel->id,
                wineId: $wineVintageModel->wine_id,
                vintage: $wineVintageModel->vintage,
                price: $wineVintageModel->price,
                agingMethod: $wineVintageModel->aging_method,
                alcoholContent: $wineVintageModel->alcohol_content,
                wineBlend: new WineBlend($grapeVarieties),
                technicalComment: $wineVintageModel->technical_comment,
                imagePath: $wineVintageModel->image_path
            );
        }
        return $wineVintages;
    }

    /**
     * @return array<array{wine: Wine, wineVintage: WineVintage}>
     * @throws Exception
     */
    public function getAllWithWine(): array
    {
        $wineVintageModels = $this->wineVintageModel->with('wine')->get();
        $wineVintagesInfo = [];
        foreach ($wineVintageModels as $wineVintageModel) {
            $grapeVarieties = [];
            foreach ($wineVintageModel->grapeVarieties as $grapeVariety) {
                $grapeVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $grapeVariety->id,
                        name: $grapeVariety->name
                    ),
                    percentage: $grapeVariety->pivot->percentage
                );
            }
            $wineVintage = new WineVintage(
                id: $wineVintageModel->id,
                wineId: $wineVintageModel->wine_id,
                vintage: $wineVintageModel->vintage,
                price: $wineVintageModel->price,
                agingMethod: $wineVintageModel->aging_method,
                alcoholContent: $wineVintageModel->alcohol_content,
                wineBlend: new WineBlend($grapeVarieties),
                technicalComment: $wineVintageModel->technical_comment,
                imagePath: $wineVintageModel->image_path
            );
            $wineModel = $wineVintageModel->wine;
            $wine = new Wine(
                id: $wineModel->id,
                name: $wineModel->name,
                producerId: $wineModel->producer_id,
                wineType: WineType::fromId($wineModel->wine_type_id),
                country: new Country(
                    id: $wineModel->country->id,
                    name: $wineModel->country->name
                )
            );
            $wineVintagesInfo[] = [
                'wine' => $wine,
                'wineVintage' => $wineVintage
            ];
        }
        return $wineVintagesInfo;
    }
}
