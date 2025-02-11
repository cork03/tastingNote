<?php

namespace App\usecase\wineVintage;

use App\domain\Image;
use App\domain\images\WineVintageImagePathCreator;
use App\gateways\FileUploader\FileUploaderInterface;
use App\gateways\repository\WineVintageRepositoryInterface;
use App\utils\Base64ImageResolver;

class CreateWineVintageAndLinkCommentUseCase implements CreateWineVintageAndLinkCommentUseCaseInterface
{
    public function __construct(
        private readonly WineVintageRepositoryInterface $wineVintageRepository,
        private readonly WineVintageImagePathCreator    $wineVintageImagePathCreator,
        private readonly FileUploaderInterface          $fileUploader
    )
    {
    }

    public function handle(CreateWineVintageAndLinkCommentUseCaseInput $input): void
    {
        try {
            if ($input->getBase64Image() === null) {
                $this->wineVintageRepository->createAndLinkComment(
                    $input->getWineVintage(),
                    null,
                    $input->getCommentId()
                );
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
                $this->wineVintageRepository->createAndLinkComment(
                    $input->getWineVintage(),
                    $path,
                    $input->getCommentId()
                );
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to upload image');
        }
    }
}
