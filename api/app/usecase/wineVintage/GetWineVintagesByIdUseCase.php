<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintage;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\WineVintageRepositoryInterface;

class GetWineVintagesByIdUseCase implements GetWineVintagesByIdUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository,
        private readonly FileUploaderInterface $fileUploader
    )
    {
    }

    /**
     * @return array<array{wineVintage: WineVintage, imagePath: ?string}>
     */
    public function handle(int $id): array
    {
         $wineVintages = $this->wineVintageRepository->getAllById($id);
         $wineVintagesInfo = [];
         foreach ($wineVintages as $wineVintage) {
             if ($wineVintage->getImagePath() === null) {
                 $wineVintagesInfo[] = ['wineVintage' => $wineVintage, 'imagePath' => null];
             } else {
                 $wineVintagesInfo[] = ['wineVintage' => $wineVintage, 'imagePath' => $this->fileUploader->getUrl($wineVintage->getImagePath())];
             }
         }
         return $wineVintagesInfo;
    }
}
