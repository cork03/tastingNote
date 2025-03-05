<?php

namespace App\usecase\wineComment\GetWineCommentUseCase;

use App\domain\Aggregate\WineComment;
use App\gateways\repository\WineCommentRepository;
use Exception;

class GetWineCommentUseCase implements GetWineCommentUseCaseInterface
{
    public function __construct(
        private readonly WineCommentRepository $wineCommentRepository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function handle(int $id): WineComment
    {
        $wineComment = $this->wineCommentRepository->getById($id);
        if (!isset($wineComment)) {
            throw new Exception('WineComment not found');
        }
        return $wineComment;
    }
}
