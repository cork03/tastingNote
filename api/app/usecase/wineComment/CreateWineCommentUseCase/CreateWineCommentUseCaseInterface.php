<?php

namespace App\usecase\wineComment\CreateWineCommentUseCase;


interface CreateWineCommentUseCaseInterface
{
    public function handle(CreateWineCommentUseCaseInput $input): void;
}
