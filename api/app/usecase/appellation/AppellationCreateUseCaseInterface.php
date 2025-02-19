<?php

namespace App\usecase\appellation;

use App\domain\Appellation;

interface AppellationCreateUseCaseInterface
{
    public function handle(Appellation $appellation): void;
}
