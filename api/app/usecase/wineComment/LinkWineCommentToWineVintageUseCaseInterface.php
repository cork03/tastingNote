<?php

namespace App\usecase\wineComment;

interface LinkWineCommentToWineVintageUseCaseInterface
{
    public function handle(int $wineCommentId, int $wineVintageId): void;
}
