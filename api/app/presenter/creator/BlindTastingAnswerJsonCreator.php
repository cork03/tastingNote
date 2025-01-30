<?php

namespace App\presenter\creator;

use App\domain\BlindTastingAnswer;
use App\presenter\jsonClass\BlindTastingAnswerJson;

class BlindTastingAnswerJsonCreator
{
    public function create(BlindTastingAnswer $blindTastingAnswer): BlindTastingAnswerJson
    {
        $wineVariety = array_map(function ($wineVariety) {
            return (new WineVarietyJsonCreator())->create($wineVariety);
        }, $blindTastingAnswer->getWineBlend()->getWineVarieties());

        return new BlindTastingAnswerJson(
            id: $blindTastingAnswer->getId(),
            wineCommentId: $blindTastingAnswer->getWineCommentId(),
            countryJson: (new CountryJsonCreator())->create($blindTastingAnswer->getCountry()),
            vintage: $blindTastingAnswer->getVintage(),
            price: $blindTastingAnswer->getPrice(),
            alcoholContent: $blindTastingAnswer->getAlcoholContent(),
            wineBlend: $wineVariety,
            anotherComment: $blindTastingAnswer->getAnotherComment(),
        );
    }
}
