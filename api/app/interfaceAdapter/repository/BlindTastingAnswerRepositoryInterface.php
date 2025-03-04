<?php

namespace App\interfaceAdapter\repository;

use App\domain\Aggregate\BlindTastingAnswer;

interface BlindTastingAnswerRepositoryInterface
{
    public function create(BlindTastingAnswer $blindTastingAnswer): void;
}
