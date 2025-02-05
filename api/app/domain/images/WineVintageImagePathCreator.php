<?php

namespace App\domain\images;

class WineVintageImagePathCreator
{
    /**
     * @throws \Exception
     */
    public function createPath(int $wineId, int $vintage, string $extension): string
    {
        return "wine/{$wineId}/vintage/{$vintage}/bottle.{$extension}";
    }
}
