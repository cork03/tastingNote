<?php

namespace App\gateways\repository;

use App\domain\TastingComment;
use App\domain\Wine;
use App\domain\WineVintage;
use App\domain\WineVintageFullInfo;

interface WineVintageRepositoryInterface
{
    public function create(WineVintage $wineVintage, ?string $imagePath): void;
    public function createAndLinkComment(WineVintage $wineVintage, ?string $imagePath, int $commentId): void;
    public function getById(int $id): ?WineVintage;
    /**
     * @return TastingComment[]
     */
    public function getWineCommentsByWineVintageId(int $wineVintageId): array;
    public function getWithWineByWineIdAndVintage(int $wineId, int $vintage): WineVintageFullInfo;

    public function update(WineVintage $wineVintage, ?string $imagePath): void;

    /**
     * @return WineVintage[]
     */
    public function getAllById(int $wineId): array;

    /**
     * @return array<array{wine: Wine, wineVintage: WineVintage}>
     */
    public function getAllWithWine(): array;
}
