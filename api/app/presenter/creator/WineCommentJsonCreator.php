<?php
namespace App\presenter\creator;

use App\domain\WineComment;
use App\presenter\jsonClass\WineCommentJson;

class WineCommentJsonCreator
{
    public function create(WineComment $wineComment): WineCommentJson
    {
        return new WineCommentJson(
            id: $wineComment->getId(),
            wineVintageId: $wineComment->getWineVintageId(),
            appearance: $wineComment->getAppearance(),
            aroma: $wineComment->getAroma(),
            taste: $wineComment->getTaste(),
            anotherComment: $wineComment->getAnotherComment(),
        );
    }
}
