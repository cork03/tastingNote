<?php

namespace App\domain\images;

use App\utils\Base64ImageResolver;

class WineVintageImagePathCreator
{
    public function __construct(private readonly Base64ImageResolver $base64ImageResolver)
    {
    }

    /**
     * @throws \Exception
     */
    public function createPath(int $wineId, int $vintage, string $base64Image): string
    {
        $extension = $this->base64ImageResolver->getExtension($base64Image);
        if (!isset($extension)) {
            throw new \Exception('Invalid base64 image');
        }
        return "wine/{$wineId}/vintage/{$vintage}/bottle.{$extension}";
    }
}
