<?php

namespace Fateme\Media\Services;

use Fateme\Media\Contracts\FileServiceContract;
use Fateme\Media\Models\Media;
use Illuminate\Support\Facades\Storage;

class VideoFileService extends DefaultFileService implements FileServiceContract
{
    public static function upload($file, $filename, $dir) : array
    {
        $filename = uniqid();
        $extension = $file->getClientOriginalExtension();
        $dir = 'private\\';
        Storage::putFileAs( $dir , $file, $filename . '.' . $extension);
        return ["video" => $filename .  '.' . $extension];
    }
    public static function thumb(Media $media)
    {
        return url("/img/video-thumb.png");
    }
}
