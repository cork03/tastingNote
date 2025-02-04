<?php

namespace App\domain;

class Image
{
    public function __construct(
        private readonly string $path,
        private readonly string $binary
    )
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getBinary(): string
    {
        return $this->binary;
    }
}
