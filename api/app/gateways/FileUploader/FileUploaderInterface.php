<?php

namespace App\gateways\FileUploader;

use App\domain\Image;

interface FileUploaderInterface
{
    public function upload(Image $image): bool;

    public function getUrl(string $path): string;
}
