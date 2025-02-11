<?php

namespace App\gateways\repository\wineVintage;

use App\domain\WineComment;

interface WineCommentRepositoryInterface
{
    public function create(WineComment $wineComment): void;

    public function linkToWineVintage(int $wineCommentId, int $wineVintageId): void;
}
