<?php

namespace App\domain;

class WineComment
{
    public function __construct(
        private readonly ?int $id,
        private readonly ?int $wine_vintage_id,
        private readonly string $appearance,
        private readonly string $aroma,
        private readonly string $taste,
        private readonly ?string $another_comment,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWineVintageId(): ?int
    {
        return $this->wine_vintage_id;
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
        return $this->another_comment;
    }
}
