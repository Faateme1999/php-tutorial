<?php

namespace Fateme\Media\Services;

class MediaFileService
{
     public static function upload($file)
{
      $extension = strtolower($file->getClientOriginalExtension());

      switch ($extension) {
          case 'jpg':
          case 'png':
          case 'jpeg':
              ImageFileService::upload($file);
              break;
          case 'avi':
          case 'mp4':
              VideoFileService::upload($file);
              break;
      }

}

    public static function delete(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::delete($media);
            }
        }
    }
}
