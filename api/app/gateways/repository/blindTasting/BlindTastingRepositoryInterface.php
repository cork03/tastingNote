<?php

namespace App\gateways\repository\blindTasting;

use App\domain\BlindTastingAnswer;
use App\domain\WineComment;

interface BlindTastingRepositoryInterface
{
    public function create(WineComment $wineComment, BlindTastingAnswer $blindTastingAnswer): int;
}
