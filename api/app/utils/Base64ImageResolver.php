<?php

namespace App\utils;

class Base64ImageResolver
{
    private readonly string $base64Image;
    public function __construct(string $base64Image)
    {
        if (!preg_match('/^data:image\/\w+;base64,/', $base64Image)) {
            throw new \Exception('Invalid base64 image');
        }
        $this->base64Image = $base64Image;
    }

    public function getExtension(): ?string
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $this->base64Image, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function getBase64String(): string
    {
        return preg_replace('/^data:image\/\w+;base64,/', '', $this->base64Image);
    }
}
