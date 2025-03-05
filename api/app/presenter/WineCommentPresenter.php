<?php

namespace App\presenter;

use App\domain\Aggregate\WineComment;
use App\presenter\jsonClass\WineCommentJson;
use Illuminate\Http\JsonResponse;

class WineCommentPresenter
{
    public function getByIdResponse(WineComment $wineComment): JsonResponse
    {
        $wineCommentJson = new WineCommentJson(
            id: $wineComment->getId(),
            wineVintageId: $wineComment->getWineVintageId(),
            appearance: $wineComment->getAppearance(),
            aroma: $wineComment->getAroma(),
            taste: $wineComment->getTaste(),
            anotherComment: $wineComment->getAnotherComment(),
        );
        return response()->json($wineCommentJson);
    }
}
