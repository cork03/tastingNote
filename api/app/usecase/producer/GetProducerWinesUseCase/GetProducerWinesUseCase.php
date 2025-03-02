<?php

namespace App\usecase\producer\GetProducerWinesUseCase;

use App\domain\Wine;
use App\gateways\FileUploader\FileUploaderInterface;
use App\interfaceAdapter\queryService\GetProducerWinesUseCaseQueryServiceInterface;

class GetProducerWinesUseCase implements GetProducerWinesUseCaseInterface
{
    public function __construct(
        private readonly GetProducerWinesUseCaseQueryServiceInterface $queryService,
        private readonly FileUploaderInterface $fileUploader,
    )
    {
    }

    /**
     * @return ProducerWineWithImagePathDTO[]
     */
    public function handle(GetProducerWinesUseCaseInput $input): array
    {
        $producerWineDTOs = $this->queryService->getWines($input->getProducerId());
        $producerWineDTOsWithImagePath = [];
        foreach ($producerWineDTOs as $producerWineDTO) {
            $imagePath = null;
            if ($producerWineDTO->getLatestVintageImagePath() !== null) {
                $imagePath = $this->fileUploader->getUrl($producerWineDTO->getLatestVintageImagePath());
            }
            $producerWineDTOsWithImagePath[] = new ProducerWineWithImagePathDTO(
                id: $producerWineDTO->getId(),
                name: $producerWineDTO->getName(),
                producerId: $producerWineDTO->getProducerId(),
                wineType: $producerWineDTO->getWineType(),
                country: $producerWineDTO->getCountry(),
                appellation: $producerWineDTO->getAppellation(),
                imagePath: $imagePath
            );
        }
        return $producerWineDTOsWithImagePath;
    }
}
