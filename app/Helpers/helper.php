<?php

use Illuminate\Support\Str;

/**
 * Henerate UUID.
 *
 * @return uuid
 */
function generateUuid()
{
    return Str::uuid();
}

if (! function_exists('is_root')) {
    function is_root(): bool
    {
        return auth()->id() == 1;
    }
}

if (! function_exists('validation_error')) {
    function validation_error($attribute)
    {
        $errors = session('errors') ?? collect();

        if ($errors->has($attribute)) {
            return '<small class="form-text text-danger">'.$errors->first($attribute).'</small>';
        }

        return '';
    }
}

if (! function_exists('per_page')) {
    function per_page($options, $default = 20)
    {
        return isset($options['per_page']) ? (int) $options['per_page'] : $default;
    }
}

if (! function_exists('order_by')) {
    function order_by($options, $sortable, $default = 'created_at')
    {
        return isset($options['order_by']) && in_array($options['order_by'], $sortable) ? $options['order_by'] : $default;
    }
}

if (! function_exists('order')) {
    function order($options, $default = 'desc')
    {
        return isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : $default;
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (access()->allow('view-backend')) {
            return 'admin.dashboard';
        }

        return 'frontend.index';
    }
}

// Global helpers file with misc functions.
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('history')) {
    /**
     * Access the history facade anywhere.
     */
    function history()
    {
        return app('history');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        $directory = $folder;
        $handle = opendir($directory);
        $directory_list = [$directory];

        while (false !== ($filename = readdir($handle))) {
            if ($filename != '.' && $filename != '..' && is_dir($directory.$filename)) {
                array_push($directory_list, $directory.$filename.'/');
            }
        }

        foreach ($directory_list as $directory) {
            foreach (glob($directory.'*.php') as $filename) {
                require $filename;
            }
        }
    }
}

if (! function_exists('getRtlCss')) {
    /**
     * The path being passed is generated by Laravel Mix manifest file
     * The webpack plugin takes the css filenames and appends rtl before the .css extension
     * So we take the original and place that in and send back the path.
     *
     * @param $path
     *
     * @return string
     */
    function getRtlCss($path)
    {
        $path = explode('/', $path);
        $filename = end($path);
        array_pop($path);
        $filename = rtrim($filename, '.css');

        return implode('/', $path).'/'.$filename.'.rtl.css';
    }
}

if (! function_exists('escapeSlashes')) {
    /**
     * Access the escapeSlashes helper.
     */
    function escapeSlashes($path)
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
        $path = str_replace('//', DIRECTORY_SEPARATOR, $path);
        $path = trim($path, DIRECTORY_SEPARATOR);

        return $path;
    }
}

if (! function_exists('getRouteUrl')) {
    /**
     * Converts querystring params to array and use it as route params and returns URL.
     */
    function getRouteUrl($url, $url_type = 'route', $separator = '?')
    {
        $routeUrl = '';

        if (! empty($url)) {
            if ($url_type == 'route') {
                if (strpos($url, $separator) !== false) {
                    $urlArray = explode($separator, $url);
                    $url = $urlArray[0];
                    parse_str($urlArray[1], $params);
                    $routeUrl = route($url, $params);
                } else {
                    $routeUrl = route($url);
                }
            } else {
                $routeUrl = $url;
            }
        }

        return $routeUrl;
    }
}

if (! function_exists('renderMenuItems')) {
    /**
     * render sidebar menu items after permission check.
     */
    function renderMenuItems($items, $viewName = 'backend.includes.partials.sidebar-item')
    {
        foreach ($items as $item) {
            // if(!empty($item->url) && !Route::has($item->url)) {
            //     return;
            // }
            if (! empty($item->view_permission_id)) {
                if (access()->allow($item->view_permission_id)) {
                    echo view($viewName, compact('item'));
                }
            } else {
                echo view($viewName, compact('item'));
            }
        }
    }
}

if (! function_exists('checkDatabaseConnection')) {
    /**
     * @return bool
     */
    function checkDatabaseConnection()
    {
        try {
            DB::connection()->reconnect();

            return true;
        } catch (Exception $ex) {
            return false;
        }
    }
}
