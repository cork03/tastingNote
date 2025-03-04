<?php

namespace App\interfaceAdapter\repository;

interface TransactionInterface
{
    public function transaction(callable $callable): mixed;
}
