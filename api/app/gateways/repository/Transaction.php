<?php

namespace App\gateways\repository;

use App\interfaceAdapter\repository\TransactionInterface;
use Illuminate\Support\Facades\DB;

class Transaction implements TransactionInterface
{
    public function transaction(callable $callable): mixed
    {
        return DB::transaction($callable);
    }
}
