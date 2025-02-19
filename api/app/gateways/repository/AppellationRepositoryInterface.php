<?php

namespace App\gateways\repository;

use App\domain\Appellation as AppellationDomain;
use App\domain\Aggregate\Appellation;
use App\domain\AppellationType;

interface AppellationRepositoryInterface
{
    public function create(AppellationDomain $appellation): void;

    public function createWithAppellationType(AppellationDomain $appellation): void;

    /**
     * @return AppellationType[]
     */
    public function getAppellationTypes(): array;

    public function getById(int $getAppellationId): ?Appellation;
}
