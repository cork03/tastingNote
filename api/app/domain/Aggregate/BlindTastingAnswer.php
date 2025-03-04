<?php

namespace App\domain\Aggregate;

use App\domain\WineBlend;

class BlindTastingAnswer
{
    public function __construct(
        private readonly ?int      $id,
        private readonly int       $wineCommentId,
        private readonly int       $countryId,
        private readonly int       $vintage,
        private readonly int       $price,
        private readonly float     $alcoholContent,
        private readonly WineBlend $wineBlend,
        private readonly ?string   $anotherComment,
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWineCommentId(): int
    {
        return $this->wineCommentId;
    }

    public function getCountryId(): int
    {
        return $this->countryId;
    }

    public function getVintage(): int
    {
        return $this->vintage;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getAlcoholContent(): float
    {
        return $this->alcoholContent;
    }

    public function getWineBlend(): WineBlend
    {
        return $this->wineBlend;
    }

    public function getAnotherComment(): ?string
    {
        return $this->anotherComment;
    }
}
