<?php

namespace App\interfaceAdapter\repository;

use App\domain\Aggregate\WineComment;

interface WineCommentRepositoryInterface
{
    public function create(WineComment $wineComment): WineComment;
    public function linkToWineVintage(int $wineCommentId, int $wineVintageId): void;
}
