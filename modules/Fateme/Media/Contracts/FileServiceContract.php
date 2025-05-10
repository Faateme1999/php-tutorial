<?php

namespace Fateme\Media\Contracts;

use Fateme\Media\Models\Media;
use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public static function upload(UploadedFile $file, string $filename, string $dir) :array ;

    public static function delete(Media $media);
}
