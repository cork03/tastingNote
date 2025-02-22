<?php

namespace App\interfaceAdapter\repository;

use App\domain\Aggregate\Appellation;

interface AppellationRepositoryInterface
{
    public function create(Appellation $appellation): void;
}
