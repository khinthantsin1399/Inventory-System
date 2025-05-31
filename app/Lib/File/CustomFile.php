<?php

namespace App\Lib\File;

use Carbon\Carbon;
use Illuminate\Support\Str;
use RuntimeException;
use Storage;

class CustomFile
{
    /**
     *
     * @param string $name
     * @param string $subDir
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    public function storage($subDir = '', $name = 'form_image')
    {
        $disk = config('filesystems.disks.' . env('FILESYSTEM_DISK', 'public'));
        $driverMethod = 'create' . ucfirst($disk['driver']) . 'Driver';
        $config = config('filesystems.business.' . $name);
        if (!$config) {
            throw new RuntimeException('Unknown storage: ' . $name);
        }
        $root = (isset($disk['root']) ? $disk['root'] . DIRECTORY_SEPARATOR : '') . $subDir;
        $url = Str::replaceFirst(public_path(), '', $root);
        $url = Str::replaceFirst(DIRECTORY_SEPARATOR, '', $url);

        return Storage::{$driverMethod}(array_merge($disk, $config, ['root' => $root, 'url' => url($url)]));
    }

    /**
     * create tempUrl
     *
     * @param string|array $path
     * @param mixed $expired
     * @param string $storage
     * @return string
     */
    public function tmpUrl(string|array $path, mixed $expired, string $storage = 'form_image'): string
    {
        $s = $this->storage('', $storage);
        if (is_array($path)) {
            $path = implode(DIRECTORY_SEPARATOR, $path);
        }
        if (is_int($expired)) {
            $expired = Carbon::now()->addSeconds($expired);
        } else if (is_string($expired)) {
            $expired = Carbon::parse($expired);
        }
    
        try {
            return $s->temporaryUrl($path, $expired);
        } catch (RuntimeException $ex) {
            return $s->url($path);
        }
    }
}
