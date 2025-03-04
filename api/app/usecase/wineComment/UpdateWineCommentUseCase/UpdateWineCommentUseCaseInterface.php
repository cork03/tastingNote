<?php

namespace App\usecase\wineComment\UpdateWineCommentUseCase;

interface UpdateWineCommentUseCaseInterface
{
    public function handle(UpdateWineCommentUseCaseInput $input): void;
}
