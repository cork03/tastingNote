<?php

namespace App\gateways\repository;

use App\domain\Aggregate\WineComment;
use App\interfaceAdapter\repository\WineCommentRepositoryInterface;
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
    public function create(WineComment $wineComment): WineComment
    {
        try {
            $wineCommentModel = $this->wineCommentModel->create([
                'wine_vintage_id' => $wineComment->getWineVintageId(),
                'appearance' => $wineComment->getAppearance(),
                'aroma' => $wineComment->getAroma(),
                'taste' => $wineComment->getTaste(),
                'another_comment' => $wineComment->getAnotherComment(),
            ]);

            return new WineComment(
                id: $wineCommentModel->id,
                wineVintageId: $wineCommentModel->wine_vintage_id,
                appearance: $wineCommentModel->appearance,
                aroma: $wineCommentModel->aroma,
                taste: $wineCommentModel->taste,
                anotherComment: $wineCommentModel->another_comment
            );
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function linkToWineVintage(int $wineCommentId, int $wineVintageId): void
    {
        $wineCommentModel = $this->wineCommentModel->find($wineCommentId);
        if (!isset($wineCommentModel)) {
            throw new Exception('WineComment not found');
        }
        $wineCommentModel->wine_vintage_id = $wineVintageId;
        $wineCommentModel->save();
    }

    public function update(WineComment $wineComment): void
    {
        $wineCommentModel = $this->wineCommentModel->find($wineComment->getId());
        if (!isset($wineCommentModel)) {
            throw new Exception('WineComment not found');
        }
        $wineCommentModel->update([
            'wine_vintage_id' => $wineComment->getWineVintageId(),
            'appearance' => $wineComment->getAppearance(),
            'aroma' => $wineComment->getAroma(),
            'taste' => $wineComment->getTaste(),
            'another_comment' => $wineComment->getAnotherComment(),
        ]);
    }
}
