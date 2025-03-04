<?php

namespace App\domain\Aggregate;

class WineComment
{
    public function __construct(
        private readonly ?int    $id,
        private readonly ?int    $wineVintageId,
        private readonly string  $appearance,
        private readonly string  $aroma,
        private readonly string  $taste,
        private readonly ?string $anotherComment,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWineVintageId(): ?int
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
