<?php

namespace App\usecase\wineComment\CreateWineCommentUseCase;

class CreateWineCommentUseCaseInput
{
    public function __construct(
        private readonly int    $wineVintageId,
        private readonly string  $appearance,
        private readonly string  $aroma,
        private readonly string  $taste,
        private readonly ?string $anotherComment,
    )
    {
    }

    public function getWineVintageId(): int
    {
        return $this->wineVintageId;
    }

    public function getAppearance(): string
    {
        return $this->appearance;
    }

    public function getAroma(): string
    {
        return $this->aroma;
    }

    public function getTaste(): string
    {
        return $this->taste;
    }

    public function getAnotherComment(): ?string
    {
        return $this->anotherComment;
    }
}
