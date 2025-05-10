<?php
return [
    "MediaTypeServices" => [
        "image" => [
            "extensions" => [
                "png", "jpg", "jpeg"
            ],
            "handler" => \Fateme\Media\Services\ImageFileService::class
        ],
        "video" => [
            "extensions" =>[
                "avi", "mp4", "mkv"
            ],
            "handler" => \Fateme\Media\Services\VideoFileService::class,
        ],
        "zip" => [
            "extensions" => [
                "zip", "rar", "tar"
            ],
            "handler" => \Fateme\Media\Services\ZipFileService::class
        ]
    ]
];
