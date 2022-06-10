<?php

namespace App\Storages;

class FileStorageFactory
{
    public static function createForOrganizations(): FileStorage
    {
        return new FileStorage('organizations');
    }

}
