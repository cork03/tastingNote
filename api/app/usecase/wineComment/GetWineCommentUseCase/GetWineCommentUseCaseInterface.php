<?php

namespace App\usecase\wineComment\GetWineCommentUseCase;

use App\domain\Aggregate\WineComment;

interface GetWineCommentUseCaseInterface
{
    public function handle(int $id): WineComment;
}
