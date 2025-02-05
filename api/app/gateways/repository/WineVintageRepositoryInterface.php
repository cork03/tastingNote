<?php

namespace App\gateways\repository;

use App\domain\TastingComment;
use App\domain\WineComment;
use App\domain\WineVintage;
use App\domain\WineVintageFullInfo;

interface WineVintageRepositoryInterface
{
    public function create(WineVintage $wineVintage, ?string $imagePath): void;
    public function getWithWineByWineIdAndVintage(int $wineId, int $vintage): WineVintageFullInfo;

    /**
     * @return TastingComment[]
     */
    public function getWineCommentsByWineVintageId(int $wineVintageId): array;

    public function getById(int $id): ?WineVintage;

    public function update(WineVintage $wineVintage, ?string $imagePath): void;
}
