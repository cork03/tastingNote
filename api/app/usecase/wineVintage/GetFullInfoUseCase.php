<?php

namespace App\usecase\wineVintage;

use App\domain\WineVintageFullInfo;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\WineVintageRepositoryInterface;

class GetFullInfoUseCase implements GetFullInfoUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository,
        private readonly FileUploaderInterface $fileUploader
    )
    {
    }

    /**
     * @return array{wineVintageFullInfo: WineVintageFullInfo, imagePath: ?string}
     */
    public function handle(int $id, int $vintage): array
    {
        $wineVintageFullInfo = $this->wineVintageRepository->getWithWineByWineIdAndVintage($id, $vintage);
        if ($wineVintageFullInfo->getImagePath() === null) {
            return ['wineVintageFullInfo' => $wineVintageFullInfo, 'imagePath' => null];
        }
        $imagePath =$this->fileUploader->getUrl($wineVintageFullInfo->getImagePath());
        return ['wineVintageFullInfo' => $wineVintageFullInfo, 'imagePath' => $imagePath];
    }
}
