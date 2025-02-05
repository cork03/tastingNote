<?php

namespace App\usecase\wineVintage;

use App\domain\Image;
use App\domain\images\WineVintageImagePathCreator;
use App\domain\WineVintage;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\utils\Base64ImageResolver;

class EditWineVintageUseCase implements EditWineVintageUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository,
        private readonly FileUploaderInterface          $fileUploader,
        private readonly WineVintageImagePathCreator    $wineVintageImagePathCreator
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function handle(WineVintage $wineVintage, ?string $base64Image): void
    {
        try {
            if (!isset($base64Image)) {
                $this->wineVintageRepository->update($wineVintage, null);
                return;
            }
            $base64ImageResolver = new Base64ImageResolver($base64Image);
            $path = $this->wineVintageImagePathCreator->createPath(
                wineId: $wineVintage->getWineId(),
                vintage: $wineVintage->getVintage(),
                extension: $base64ImageResolver->getExtension()
            );
            $isSuccess = $this->fileUploader->upload(
                new Image(
                    path: $path,
                    binary: base64_decode($base64ImageResolver->getBase64String())
                )
            );
            if (!$isSuccess) {
                throw new \Exception('Failed to upload image');
            }
            $this->wineVintageRepository->update($wineVintage, $path);
        } catch (\Exception $e) {
            throw new \Exception('Failed to upload image');
        }
    }
}
