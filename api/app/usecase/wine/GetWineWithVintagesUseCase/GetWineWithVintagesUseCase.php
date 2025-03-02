<?php

namespace App\usecase\wine\GetWineWithVintagesUseCase;

use App\gateways\FileUploader\FileUploaderInterface;
use App\interfaceAdapter\queryService\GetWineWithVintagesUseCaseQueryServiceInterface;

class GetWineWithVintagesUseCase implements GetWineWithVintagesUseCaseInterface
{
    public function __construct(
        private readonly GetWineWithVintagesUseCaseQueryServiceInterface $queryService,
        private readonly FileUploaderInterface $fileUploader
    )
    {
    }

    public function handle(int $wineId): WineInfoDTO
    {
        $wineInfoDTO = $this->queryService->getWineWithVintagesById($wineId);
        $wineVintageDTOs = [];
        foreach ($wineInfoDTO->getWine()->getVineVintages() as $wineVintageDTO) {
            if ($wineVintageDTO->getImagePath() !== null) {
                $wineVintageDTOs[] = new WineVintageDTO(
                    id: $wineVintageDTO->getId(),
                    wineId: $wineVintageDTO->getWineId(),
                    vintage: $wineVintageDTO->getVintage(),
                    price: $wineVintageDTO->getPrice(),
                    agingMethod: $wineVintageDTO->getAgingMethod(),
                    alcoholContent: $wineVintageDTO->getAlcoholContent(),
                    wineBlend: $wineVintageDTO->getWineBlend(),
                    technicalComment: $wineVintageDTO->getTechnicalComment(),
                    imagePath: $this->fileUploader->getUrl($wineVintageDTO->getImagePath())
                );
            } else {
                $wineVintageDTOs[] = $wineVintageDTO;
            }
        }
        $wineDTO = $wineInfoDTO->getWine();
        return new WineInfoDTO(
            producer: $wineInfoDTO->getProducer(),
            wine: new WineDTO(
                id: $wineDTO->getId(),
                name: $wineDTO->getName(),
                producerId: $wineDTO->getProducerId(),
                wineType: $wineDTO->getWineType(),
                country: $wineDTO->getCountry(),
                vineVintages: $wineVintageDTOs,
                appellation: $wineDTO->getAppellation()
            )
        );
    }
}
