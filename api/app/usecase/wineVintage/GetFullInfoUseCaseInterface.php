<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintageFullInfo;

interface GetFullInfoUseCaseInterface
{
    public function handle(int $id, int $vintage): WineVintageFullInfo;
}
