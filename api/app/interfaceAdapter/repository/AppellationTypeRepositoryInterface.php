<?php

namespace App\interfaceAdapter\repository;

use App\domain\Aggregate\AppellationType;

interface AppellationTypeRepositoryInterface
{
    public function create(AppellationType $appellationType): AppellationType;
}
