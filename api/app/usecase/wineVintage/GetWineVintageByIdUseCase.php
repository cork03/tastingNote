<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintage;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\WineVintageRepositoryInterface;

class GetWineVintageByIdUseCase implements GetWineVintageByIdUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository,
        private readonly FileUploaderInterface $fileUploader
    )
    {
    }
    /**
     * @return ?array{wineVintage: WineVintage, imagePath: ?string}
     */
    public function handle(int $id): ?array
    {
        $wineVintage = $this->wineVintageRepository->getById($id);
        if (!isset($wineVintage)) {
            return null;
        }
        if ($wineVintage->getImagePath() === null) {
            return ['wineVintage' => $wineVintage, 'imagePath' => null];
        }
        return ['wineVintage' => $wineVintage, 'imagePath' => $this->fileUploader->getUrl($wineVintage->getImagePath())];
    }
}
