<?php

namespace App\Storages;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

class FileStorage
{
    protected Filesystem $storage;

    public function __construct(private string $prefix)
    {
        $this->storage = Storage::disk(self::diskStorageName());
    }

    public static function diskStorageName()
    {
        return config('iot.file_storage_disk');
    }

    public static function fake(): Filesystem
    {
        return Storage::fake(self::diskStorageName());
    }

    public function uploadFile($file): ?string
    {
        if (isset($file) && ! empty($file)) {
            $file_name = time().$file->getClientOriginalName();

            $this->storage->put($this->buildFilePath($file_name), file_get_contents($file->getRealPath()));

            return $file_name;
        }

        return null;
    }

    public function buildFilePath(string $file_name): string
    {
        return $this->getUploadPath().$file_name;
    }

    public function getUploadPath(): string
    {
        return $this->getBaseUploadPath();
    }

    public function getBaseUploadPath(): string
    {
        return 'files'.DIRECTORY_SEPARATOR.$this->prefix.DIRECTORY_SEPARATOR;
    }

    public function deleteFile($file_name): bool
    {
        if (isset($file_name) && ! empty($file_name)) {
            return $this->storage->delete($this->buildFilePath($file_name));
        }

        return true;
    }

    public function url(string $file_name): string
    {
        return $this->storage->url($this->buildFilePath($file_name));
    }

    public function assertExists($file_name)
    {
        $this->storage->assertExists($this->buildFilePath($file_name));
    }

    public function assertMissing($file_name)
    {
        $this->storage->assertMissing($this->buildFilePath($file_name));
    }

    public function fullUrl($featured_image): string
    {
        return $this->storage->url($this->buildFilePath($featured_image));
    }
}
