<?php

namespace App\presenter;

use App\domain\TastingComment;
use App\domain\WineVintageFullInfo;
use App\presenter\creator\BlindTastingAnswerJsonCreator;
use App\presenter\creator\ProducerJsonCreator;
use App\presenter\creator\WineCommentJsonCreator;
use App\presenter\jsonClass\CountryJson;
use App\presenter\jsonClass\TastingCommentJson;
use App\presenter\jsonClass\WineJson;
use App\presenter\jsonClass\WineTypeJson;
use App\presenter\jsonClass\WineVarietyJson;
use App\presenter\jsonClass\WineVintageFullInfoJson;
use Illuminate\Http\JsonResponse;

class WineVintagePresenter
{

    /**
     * @param array{wineVintageFullInfo: WineVintageFullInfo, imagePath: string} $wineVintageFullInfos
     */
    function getFullInfoResponse(array $wineVintageFullInfos): JsonResponse
    {
        $wineVintageFullInfo = $wineVintageFullInfos['wineVintageFullInfo'];
        $producer = $wineVintageFullInfo->getProducer();
        $wine = $wineVintageFullInfo->getWine();
        $wineVintageFullInfoJson = new WineVintageFullInfoJson(
            id: $wineVintageFullInfo->getId(),
            producer: (new ProducerJsonCreator())->create($producer),
            wine: new WineJson(
                id: $wine->getId(),
                name: $wine->getName(),
                producerId: $wine->getProducerId(),
                wineType: new WineTypeJson(
                    id: $wine->getWineType()->value,
                    label: $wine->getWineType()->getLabel(),
                ),
                country: new CountryJson(
                    id: $wine->getCountry()->getId(),
                    name: $wine->getCountry()->getName(),
                )
            ),
            vintage: $wineVintageFullInfo->getVintage(),
            price: $wineVintageFullInfo->getPrice(),
            agingMethod: $wineVintageFullInfo->getAgingMethod(),
            alcoholContent: $wineVintageFullInfo->getAlcoholContent(),
            wineBlend: array_map(
                fn($wineVariety) => new WineVarietyJson(
                    name: $wineVariety->getGrapeVariety()->getName(),
                    percentage: $wineVariety->getPercentage(),
                ),
                $wineVintageFullInfo->getWineBlend()->getWineVarieties()
            ),
            technicalComment: $wineVintageFullInfo->getTechnicalComment(),
            imagePath: $wineVintageFullInfos['imagePath']
        );
        return response()->json($wineVintageFullInfoJson);
    }

    /**
     * @param TastingComment[] $tastingComments
     */
    function getWineCommentsResponse(array $tastingComments): JsonResponse
    {
        $tastingCommentsJson = [];
        foreach ($tastingComments as $tastingComment) {
            $wineComment = $tastingComment->getWineComment();
            $wineCommentJson = (new WineCommentJsonCreator())->create($wineComment);
            $blindTastingAnswer = $tastingComment->getBlindTastingAnswer();
            if (!isset($blindTastingAnswer)) {
                $tastingCommentsJson[] = new TastingCommentJson(
                    wineComment: $wineCommentJson,
                    blindTastingAnswer: null
                );
                continue;
            }
           $tastingCommentsJson[] = new TastingCommentJson(
               wineComment: $wineCommentJson,
               blindTastingAnswer: (new BlindTastingAnswerJsonCreator())->create($blindTastingAnswer)
           ) ;
        }
        return response()->json($tastingCommentsJson);
    }
}
