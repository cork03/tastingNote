<?php

namespace App\usecase\wineVintage;

use App\domain\Image;
use App\domain\images\WineVintageImagePathCreator;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\usecase\wine\CreateWineVintageUseCaseInput;
use Illuminate\Support\Facades\Storage;

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
                $path = $this->wineVintageImagePathCreator->createPath(
                    wineId: $input->getWineVintage()->getWineId(),
                    vintage: $input->getWineVintage()->getVintage(),
                    base64Image: $input->getBase64Image());
                $base64_string = preg_replace('/^data:image\/\w+;base64,/', '', $input->getBase64Image());
                $isSuccess = $this->fileUploader->upload(
                    new Image(
                        path: $path,
                        binary: base64_decode($base64_string)
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
