<?php

namespace App\utils;

class Base64ImageResolver
{
    public function getExtension(string $base64Image): ?string
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
