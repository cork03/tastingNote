<?php

namespace App\usecase\wineVintage;

use App\domain\WineComment;

interface GetWineCommentsUseCaseInterface
{
    /**
     * @return WineComment[]
     */
    public function handle(int $wineVintageId): array;
}
