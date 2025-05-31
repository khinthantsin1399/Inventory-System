<?php 

    return [
        'IMG_TYPES' => ["apng", "avif", "pjpeg", "pjp", "svg", "ico", "cur", "jpg", "jpeg", "png", "gif", "bmp", "webp", "tif", "tiff", "jfif"],
  
        'IMG_NAME_MAX_LENGTH' => env('IMG_NAME_MAX_LENGTH', 100),
        
        'MAX_IMG_SIZE' => env('MAX_IMG_SIZE', 5 * 1024 * 1024), //5MB
    ];
