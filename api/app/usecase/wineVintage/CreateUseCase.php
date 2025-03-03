<?php

namespace App\usecase\wineVintage;

use App\domain\Image;
use App\domain\images\WineVintageImagePathCreator;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\utils\Base64ImageResolver;

class CreateUseCase implements CreateUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository,
        private readonly WineVintageImagePathCreator    $wineVintageImagePathCreator,
        private readonly FileUploaderInterface          $fileUploader
    )
    {
    }

    public function handle(CreateWineVintageUseCaseInput $input): void
    {
        try {
            if ($input->getBase64Image() === null) {
                $this->wineVintageRepository->create($input->getWineVintage(), null);
            } else {
                $base64ImageResolver = new Base64ImageResolver($input->getBase64Image());
                $path = $this->wineVintageImagePathCreator->createPath(
                    wineId: $input->getWineVintage()->getWineId(),
                    vintage: $input->getWineVintage()->getVintage(),
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
                $this->wineVintageRepository->create($input->getWineVintage(), $path);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to upload image');
        }
    }
}
