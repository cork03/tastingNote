<?php

namespace App\gateways\repository;

use App\domain\Country;
use App\domain\GrapeVariety;
use App\domain\Producer;
use App\domain\Aggregate\Wine;
use App\domain\Wine as WineDomain;
use App\domain\WineBlend;
use App\domain\WineType;
use App\domain\WineVariety;
use App\domain\WineVintage;
use App\domain\WineFullInfo;
use App\Models\Wine as WineModel;
use Exception;
use Illuminate\Support\Facades\Log;

class WineRepository implements WineRepositoryInterface
{
    public function __construct(private readonly WineModel $wineModel)
    {
    }

    /**
     * @throws Exception
     */
    public function create(Wine $wine): Wine
    {
        try {
            $wineModel = $this->wineModel->create([
                'name' => $wine->getName(),
                'producer_id' => $wine->getProducerId(),
                'wine_type_id' => $wine->getWineTypeId(),
                'country_id' => $wine->getCountryId(),
                'appellation_id' => $wine->getAppellationId()
            ]);
            return new Wine(
                id: $wineModel->id,
                name: $wineModel->name,
                producerId: $wineModel->producer_id,
                wineTypeId: $wineModel->wine_type_id,
                countryId: $wineModel->country_id,
                appellationId: $wineModel->appellation_id
            );
        } catch (Exception $e) {
            Log::info($e->getMessage());
            throw $e;
        }
    }

    /**
     * @return array<array{producer: Producer, wine: WineDomain}>
     * @throws Exception
     */
    public function getAll(): array
    {
        $wineEntities = $this->wineModel->with(['producer.country', 'country'])->orderBy('country_id')->get();
        $wines = [];
        foreach ($wineEntities as $wineEntity) {
            $wines[] = [
                'producer' => new Producer(
                    id: $wineEntity->producer->id,
                    name: $wineEntity->producer->name,
                    country: new Country(
                        $wineEntity->producer->country->id,
                        $wineEntity->producer->country->name
                    ),
                    description: $wineEntity->producer->description,
                    url: $wineEntity->producer->url
                ),
                'wine' => new WineDomain(
                    id: $wineEntity->id,
                    name: $wineEntity->name,
                    producerId: $wineEntity->producer_id,
                    wineType: WineType::fromId($wineEntity->wine_type_id),
                    country: new Country($wineEntity->country_id, $wineEntity->country->name),
                )
            ];
        }
        return $wines;
    }

    /**
     * @throws Exception
     */
    public function getWineWithVintagesById(int $wineId): WineFullInfo
    {
        $wineWithVintagesEntity = $this->wineModel->with(['vineVintages.grapeVarieties', 'country', 'producer.country'])->find($wineId);
        if (!isset($wineWithVintagesEntity)) {
            throw new Exception('Wine not found');
        }
        $wineVintageEntities = $wineWithVintagesEntity->vineVintages;
        $wineVintages = [];
        foreach ($wineVintageEntities as $wineVintageEntity) {
            $grapeVarieties = [];
            foreach ($wineVintageEntity->grapeVarieties as $grapeVariety) {
                $grapeVarieties[] = new WineVariety(
                    grapeVariety: new GrapeVariety(
                        id: $grapeVariety->id,
                        name: $grapeVariety->name
                    ),
                    percentage: $grapeVariety->pivot->percentage
                );
            }
            $wineVintages[] = new WineVintage(
                id: $wineVintageEntity->id,
                wineId: $wineVintageEntity->wine_id,
                vintage: $wineVintageEntity->vintage,
                price: $wineVintageEntity->price,
                agingMethod: $wineVintageEntity->aging_method,
                alcoholContent: $wineVintageEntity->alcohol_content,
                wineBlend: new WineBlend($grapeVarieties),
                technicalComment: $wineVintageEntity->technical_comment
            );
        }
        return new WineFullInfo(
            wine: new WineDomain(
                id: $wineWithVintagesEntity->id,
                name: $wineWithVintagesEntity->name,
                producerId: $wineWithVintagesEntity->producer_id,
                wineType: WineType::fromId($wineWithVintagesEntity->wine_type_id),
                country: new Country(
                    id: $wineWithVintagesEntity->country->id,
                    name: $wineWithVintagesEntity->country->name
                )
            ),
            producer: new Producer(
                id: $wineWithVintagesEntity->producer->id,
                name: $wineWithVintagesEntity->producer->name,
                country: new Country(
                    id: $wineWithVintagesEntity->producer->country->id,
                    name: $wineWithVintagesEntity->producer->country->name
                ),
                description: $wineWithVintagesEntity->producer->description,
                url: $wineWithVintagesEntity->producer->url
            ),
            wineVintages: $wineVintages
        );
    }
}
