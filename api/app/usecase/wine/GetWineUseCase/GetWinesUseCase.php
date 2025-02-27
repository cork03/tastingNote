<?php

namespace App\usecase\wine\GetWineUseCase;

use App\gateways\FileUploader\FileUploaderInterface;
use App\interfaceAdapter\queryService\GetWinesUseCaseQueryServiceInterface;

class GetWinesUseCase implements GetWinesUseCaseInterface
{
    public function __construct(
        private readonly GetWinesUseCaseQueryServiceInterface $queryService,
        private readonly FileUploaderInterface $fileUploader,
    )
    {
    }

    /**
     * @return wineDTOWithImagePath[]
     */
    public function handle(): array
    {
        $wineDTOs = $this->queryService->getWines();
        $winDTOsWithImagePath = [];
        foreach ($wineDTOs as $wineDTO) {
            $imagePath = null;
            if ($wineDTO->getLatestVintageImagePath() !== null) {
                $imagePath = $this->fileUploader->getUrl($wineDTO->getLatestVintageImagePath());
            }
            $winDTOsWithImagePath[] = new wineDTOWithImagePath(
                id: $wineDTO->getId(),
                name: $wineDTO->getName(),
                wineTypeId: $wineDTO->getWineTypeId(),
                wineTypeName: $wineDTO->getWineTypeName(),
                countryId: $wineDTO->getCountryId(),
                countryName: $wineDTO->getCountryName(),
                producer: $wineDTO->getProducer(),
                appellation: $wineDTO->getAppellation(),
                latestVintageImagePath: $imagePath
            );
        }
        return $winDTOsWithImagePath;
    }
}
