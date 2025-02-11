<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintage;

class CreateWineVintageAndLinkCommentUseCaseInput
{
    public function __construct(
        private readonly WineVintage $wineVintage,
        private readonly ?string $base64Image,
        private readonly int $commentId
    )
    {
    }

    public function getWineVintage(): WineVintage
    {
        return $this->wineVintage;
    }

    public function getBase64Image(): ?string
    {
        return $this->base64Image;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }
}
