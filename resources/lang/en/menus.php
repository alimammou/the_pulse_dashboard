<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Access',

            'roles' => [
                'all' => 'All Roles',
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'main' => 'Roles',
            ],

            'users' => [
                'all' => 'All Users',
                'active' => 'Active Users',
                'change-password' => 'Change Password',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'main' => 'Users',
                'view' => 'View User',
            ],

            'permissions' => [
                'all' => 'All Permissions',
                'create' => 'Create Permission',
                'deactivated' => 'Deactivated Permission',
                'deleted' => 'Deleted Permissions',
                'edit' => 'Edit Permission',
                'main' => 'Permissions',
                'view' => 'View Permission',
                'management' => 'Permission Management',
            ],
        ],

        'organizations' => [
            'all' => 'All Organizations',
            'active' => 'Active Organizations',
            'create' => 'Create Organization',
            'deactivated' => 'Deactivated Organizations',
            'deleted' => 'Deleted Organizations',
            'edit' => 'Edit Organization',
            'main' => 'Organizations',
            'view' => 'View Organization',
        ],

        'coalitions' => [
            'all' => 'All Coalitions',
            'active' => 'Active Coalitions',
            'create' => 'Create Coalition',
            'deactivated' => 'Deactivated Coalitions',
            'deleted' => 'Deleted Coalitions',
            'edit' => 'Edit Coalitions',
            'main' => 'Coalitions',
            'view' => 'View Coalition',
        ],

        'log-viewer' => [
            'main' => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general' => 'General',
            'history' => 'History',
            'system' => 'System',
            'sensors' => 'Sensors',
            'vendors' => 'Vendors',
            'asset-types' => 'Asset Types',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => 'عربى (Arabic)',
            'en' => 'English',
        ],
    ],
];
