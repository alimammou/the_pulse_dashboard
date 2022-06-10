<?php

if (! function_exists('include_files_in_folder')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_files_in_folder($folder)
    {
        try {
            $rdi = new RecursiveDirectoryIterator($folder, RecursiveDirectoryIterator::SKIP_DOTS);
            $it = new RecursiveIteratorIterator($rdi, RecursiveIteratorIterator::SELF_FIRST);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require_once $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (! function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function include_route_files($folder)
    {
        include_files_in_folder($folder);
    }
}
