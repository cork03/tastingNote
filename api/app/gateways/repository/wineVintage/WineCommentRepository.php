<?php

namespace App\gateways\repository\wineVintage;

use App\domain\WineComment;
use App\Models\WineComment as WineCommentModel;
use Exception;
use Illuminate\Support\Facades\Log;

class WineCommentRepository implements WineCommentRepositoryInterface
{
    public function __construct(private readonly WineCommentModel $wineCommentModel)
    {
    }

    /**
     * @throws Exception
     */
    public function create(WineComment $wineComment): void
    {
        try {
            $this->wineCommentModel->create([
                'wine_vintage_id' => $wineComment->getWineVintageId(),
                'appearance' => $wineComment->getAppearance(),
                'aroma' => $wineComment->getAroma(),
                'taste' => $wineComment->getTaste(),
                'another_comment' => $wineComment->getAnotherComment(),
            ]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }
}
