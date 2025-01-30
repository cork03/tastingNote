<?php

namespace App\usecase\wineVintage;

use App\domain\TastingComment;

interface GetWineCommentsUseCaseInterface
{
    /**
     * @return TastingComment[]
     */
    public function handle(int $wineVintageId): array;
}
