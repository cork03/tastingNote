<?php

namespace App\usecase\wineVintage;

interface CreateWineVintageAndLinkCommentUseCaseInterface
{
    public function handle(CreateWineVintageAndLinkCommentUseCaseInput $input): void;
}
