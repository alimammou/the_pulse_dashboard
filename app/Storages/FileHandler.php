<?php

namespace App\Storages;

class FileHandler
{
    public function __construct(private FileStorage $storage)
    {
    }

    public function create(array $input, $uploaded_file_field, $file_field): array
    {
        $logo = $input[$uploaded_file_field] ?? null;
        unset($input[$uploaded_file_field]);

        if ($logo == null) {
            return $input;
        }

        $file_name = $this->storage->uploadFile($logo);
        $input[$file_field] = $file_name;

        return $input;
    }

    /**
     * if no file is provided, it will NOT delete the old file.
     */
    public function update(
        array $input,
        string $uploaded_file_field,
        string $file_field,
        ?string $old_file_name
    ): array {
        $file = $input[$uploaded_file_field] ?? null;

        if (! $file) {
            return $input;
        }

        $file_name = $this->storage->uploadFile($file);
        unset($input[$uploaded_file_field]);
        $input[$file_field] = $file_name;

        $this->storage->deleteFile($old_file_name);

        return $input;
    }

    /**
     * if not file is provided, it will force delete the old file.
     */
    public function forceUpdate(
        array $input,
        string $uploaded_file_field,
        string $file_field,
        ?string $old_file_name
    ): array {
        $file = $input[$uploaded_file_field] ?? null;

        $this->storage->deleteFile($old_file_name);

        if (! $file) {
            return $input;
        }

        $file_name = $this->storage->uploadFile($file);
        unset($input[$uploaded_file_field]);
        $input[$file_field] = $file_name;

        return $input;
    }
}
