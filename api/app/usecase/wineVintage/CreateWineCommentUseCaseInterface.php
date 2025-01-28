<?php

namespace App\usecase\wineVintage;

use App\domain\WineComment;

interface CreateWineCommentUseCaseInterface
{
    public function handle(WineComment $wineComment): void;
}
