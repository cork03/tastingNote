<?php

namespace App\gateways\FileUploader;

use App\domain\Image;
use Illuminate\Support\Facades\Storage;

class S3FIleUploader implements FileUploaderInterface
{
    public function upload(Image $image): bool
    {
        return Storage::disk('s3')->put($image->getPath(), $image->getBinary());
    }

    public function getUrl(string $path): string
    {
        return Storage::disk('s3')->url($path);
    }
}
