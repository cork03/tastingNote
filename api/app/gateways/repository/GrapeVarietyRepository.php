<?php

namespace App\gateways\repository;

use App\domain\GrapeVariety;
use App\Models\GrapeVariety as GrapeVarietyModel;
use Exception;
use Illuminate\Support\Facades\Log;

class GrapeVarietyRepository implements GrapeVarietyRepositoryInterface
{
    public function __construct(private readonly GrapeVarietyModel $grapeVarietyModel)
    {
    }

    /**
     * @return GrapeVariety[]
     * @throws Exception
     */
    public function getAll(): array
    {
        try {
            $grapeVarietyEntities =  $this->grapeVarietyModel->get();
            $grapeVarieties = [];
            foreach ($grapeVarietyEntities as $grapeVarietyEntity) {
                $grapeVarieties[] = new GrapeVariety(
                    $grapeVarietyEntity->id,
                    $grapeVarietyEntity->name
                );
            }
            return $grapeVarieties;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }
}
